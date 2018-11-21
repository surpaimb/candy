<?php

namespace App\Api\Orders\Services;

use GetCandyClient;
use Session;
use App\Api\BaseService;
use Log;

class OrderService extends BaseService
{

    public function __construct()
    {
        parent::__construct();
    }

    public function get($orderId = '', $params = [])
    {
        $query = '';
        if (!empty($params)) {
            $query = '?'.http_build_query($params);
        }
        try {
            $order = GetCandyClient::Orders($orderId.$query)->get();
        } catch (\Exception $e) {
            return $e->getMessage();
        }

        return $order['data'];

    }

    public function create($basketId, $params = [])
    {
        $params['basket_id'] = $basketId;

        try {
            $order = GetCandyClient::Orders()->create($params);
        } catch (\Exception $e) {
            return $e->getMessage();
        }

        return $order['data'];

    }

    public function setDeliveryAddress($orderId, $address)
    {

        $url = $orderId .'/shipping/address?'. http_build_query($address);

        try {
            $order = GetCandyClient::Orders($url)->put();
        } catch (\Exception $e) {
            return $e->getMessage();
        }

        return $order['data'];

    }

    public function getPaymentTypes()
    {
        $types = [];
        try {
            $types = GetCandyClient::Payment()->types();
            Log::info('types',[$types]);
        } catch (\Exception $e) {
            return $e->getMessage();
        }
        return $types;
    }

    public function getDeliveryMethods($orderId)
    {

        $url = $orderId .'/shipping/methods';
        $params['includes'] = 'method';

        try {
            $deliveryMethods = GetCandyClient::Orders($url.'?'.http_build_query($params))->get();

        } catch(\Exception $e) {
            return $e->getMessage();

        }

        return $deliveryMethods;

    }

    public function setDeliveryMethod($orderId, $priceId)
    {

        $url = $orderId .'/shipping/cost?price_id='. $priceId;

        try {
            $order = GetCandyClient::Orders($url)->put();
        } catch(\Exception $e) {
            return $e->getMessage();
        }

        return $order['data'];

    }

    public function setContactDetails($orderId, $data)
    {

        $url = $orderId ."/contact?". http_build_query($data);

        try {
            $order = GetCandyClient::Orders($url)->put();
        } catch(\Exception $e) {
            return $e->getMessage();
        }

        return $order['data'];

    }

    public function setBillingAddress($orderId, $formData)
    {

        $url = $orderId ."/billing/address?". http_build_query($formData);

        try {
            $order = GetCandyClient::Orders($url)->put();
        } catch (\Exception $e) {
            return $e->getMessage();
        }

        return $order['data'];
    }

    public function process($orderId, $params = [])
    {
        $params['order_id'] = $orderId;


        $url = 'process?'. http_build_query($params);

        \Log::info(http_build_query($params));

        return GetCandyClient::Orders($url)->post();
    }

    public function invoice($orderId)
    {
        $url = $orderId. '/invoice';

        return GetCandyClient::Orders()->get($url);
    }

}
