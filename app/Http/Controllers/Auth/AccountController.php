<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Http\Requests\AccountDetailsRequest;
use App\Http\Requests\ChangePasswordRequest;

use App\Api\Orders\Services\OrderService;

use Session;
use Auth;
use GetCandyClient;

class AccountController extends Controller
{
    protected $orders;

    public function __construct(OrderService $orders)
    {
        parent::__construct();

        $this->orders = $orders;
    }

    public function index()
    {
        return view('auth/account');
    }

    public function showDetails()
    {
        $customer = GetCandyClient::Users()->current();
        return view('auth/account-details')
            ->with('customer', $customer['data']);
    }

    public function postDetails(AccountDetailsRequest $request)
    {
        $user = Session::get('user');

        try {
            $response = GetCandyClient::Users()->put($user['id'].'?'. http_build_query($request->except(['_token'])));
        } catch (\Exception $e) {
            return back()->withErrors(json_decode($e->getResponse()->getBody()->getContents()))->withInput();
        }

        return redirect()->back()
            ->with('customer', $response['data'])
            ->with('success', true);

    }

    public function showOrders()
    {
        $customer = GetCandyClient::Users()->current();
        $orders = $this->orders->get();

        return view('auth/account-orders')
            ->with('customer', $customer['data'])
            ->with('orders', $orders);
    }

    public function showOrderDetails($orderId)
    {
        $customer = GetCandyClient::Users()->current();
        $order = $this->orders->get($orderId, ['includes' => 'lines,transactions']);

        return view('auth/account-order-detail')
            ->with('customer', $customer['data'])
            ->with('order', $order);
    }

    public function invoice($orderId)
    {
        $invoice = $this->orders->invoice($orderId);
        $order = $this->orders->get($orderId);

        $contents = base64_decode($invoice['data']['contents']);
        $file = 'invoices/' . $order['invoice_reference'] . '.pdf';

        \Storage::put($file, $contents);

        return response()->download(
            storage_path('app/' . $file),
            $order['invoice_reference'] . '.pdf'
        );
    }

    public function showPassword()
    {
        $customer = GetCandyClient::Users()->current();

        return view('auth/account-password')
            ->with('customer', $customer['data']);
    }

    public function changePassword(ChangePasswordRequest $request)
    {
        try {
            $response = GetCandyClient::Account()->password($request->only(['current_password', 'password', 'password_confirmation']));
        } catch (\Exception $e) {
            return back()->withErrors(json_decode($e->getResponse()->getBody()->getContents()))->withInput();
        }

        return redirect()->back()->with('success', true);
    }

    public function emailOrderInvoice()
    {
    }

}
