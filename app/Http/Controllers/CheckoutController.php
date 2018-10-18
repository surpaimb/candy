<?php

namespace App\Http\Controllers;

use App\Http\Requests\BillingAddressRequest;
use App\Http\Requests\ContactDetailsRequest;
use App\Http\Requests\DeliveryAddressRequest;
use App\Http\Requests\DeliveryMethodRequest;
use App\Http\Requests\ProcessOrderRequest;
use App\Http\Requests\Request;

use App\Api\Countries\Services\CountryService;
use App\Api\Orders\Services\OrderService;
use App\Api\Auth\Services\UserService;

use App\Mail\OrderConfirmation;
use App\Mail\AdminOrderNotification;
use GetCandyClient;
use Mail;
use Session;

class CheckoutController extends Controller
{
    protected $countries;
    protected $orders;
    protected $users;

    public function __construct(CountryService $countries, OrderService $orders, UserService $users)
    {
        parent::__construct();

        $this->countries = $countries;
        $this->orders = $orders;
        $this->users = $users;
    }

    public function show()
    {
        // Set Variables
        $basketId = Session::get('basket_id');

        if (!$basketId) {
            return redirect('/');
        }

        $user = $this->users->current();

        // Either create new order with basket id or load exisiting order
        $order = $this->orders->create($basketId);

        // if the order is complete redirect to confirmation page
        if ($order['status'] == 'received-payment') {
            return redirect('checkout/confirmation');
        }

        $regions = $this->countries->get();
        $deliveryMethods = $this->orders->getDeliveryMethods($order['id']);
        $paymentAuth = GetCandyClient::Payment()->get();

        return view('checkout')
            ->with('regions', $regions)
            ->with('order', $order)
            ->with('deliveryMethods', $deliveryMethods['data'])
            ->with('paymentAuth', $paymentAuth['data']['client_token']);
    }

    public function postDeliveryAddress(DeliveryAddressRequest $request)
    {
        $orderId = Session::get('order_id');

        $order = $this->orders->setDeliveryAddress($orderId, $request->all());
        $deliveryMethods = $this->orders->getDeliveryMethods($orderId);

        return response()->json([
            'order' => $order,
            'deliveryMethods' => $deliveryMethods
        ]);
    }

    public function postDeliveryMethod(DeliveryMethodRequest $request)
    {
        $orderId = Session::get('order_id');

        $order = $this->orders->setDeliveryMethod($orderId, $request->price_id);

        return response()->json([
            'order' => $order
        ]);
    }

    public function postContactDetails(ContactDetailsRequest $request)
    {
        $orderId = Session::get('order_id');

        $order = $this->orders->setContactDetails($orderId, $request->only('email', 'phone'));

        return response()->json([
            'order' => $order
        ]);
    }

    public function postBillingAddress(BillingAddressRequest $request)
    {
        $orderId = Session::get('order_id');
        $basketId = Session::get('basket_id');

        $params['excl_tax'] = ($request->vat_no);

        $order = $this->orders->setBillingAddress($orderId, $request->all());

        return response()->json([
            'order' => $order
        ]);
    }

    public function getPaymentTypes()
    {
        $types = $this->orders->getPaymentTypes();
        return response()->json($types);
    }

    public function proccessOrder(ProcessOrderRequest $request)
    {
        $orderId = Session::get('order_id');

        try {
            $this->orders->process($orderId, $request->only(['payment_token', 'notes', 'payment_type_id']));
        } catch (\Exception $e) {
            return response()->json(json_decode($e->getResponse()->getBody()->getContents()), 400);
        }

        $order = $this->orders->get($orderId, [
            'includes' => 'lines,discounts'
        ]);

        $orderConfirmation = Mail::to($order['contact_email'])->send(new OrderConfirmation($order));
        $adminConfirmation = Mail::to(env('MAIL_TO_ADDRESS', ''))->send(new AdminOrderNotification($order));

        return response()->json(['status' => 'success'], 200);
    }

    public function showConfirmation()
    {
        // If order is made move orderid to complete and remove order id
        if (Session::has('order_id')) {
            Session::put('complete_order_id', Session::get('order_id'));
            Session::forget('order_id');
            Session::forget('basket_id');
        }

        $orderId = Session::get('complete_order_id');

        $order = $this->orders->get($orderId, [
            'includes' => 'lines'
        ]);

        if (empty($orderId)) {
            return abort(404);
        }

        return view('confirmation')
            ->with('order', $order);
    }
}
