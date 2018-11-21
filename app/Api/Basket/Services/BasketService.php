<?php

namespace App\Api\Basket\Services;

use Log;
use GetCandyClient;
use App\Api\BaseService;

class BasketService extends BaseService
{

    public function __construct()
    {
        parent::__construct();
    }

    public function get($basketId = null)
    {
        if (empty($basketId)) {
            return [];
        }

        // Build Includes
        $params['includes'] = 'lines.variant.product.routes,discounts.rewards,lines.variant.tiers';

        // Get Basket data
        try {
            $basket = GetCandyClient::Basket($basketId . '?' . http_build_query($params))->get();
        } catch (\Exception $e) {
            session()->forget('basket_id');
            return [];
        }

        if (!$basket) {
            return [];
        }

        // Tidy data
        $basketData = [
            'tax_total' => $basket['data']['tax_total'],
            'total' => $basket['data']['total'],
            'discount' => $basket['data']['discounts'],
        ];

        foreach ($basket['data']['lines']['data'] as $line) {

            $basketData['lines'][] = [
                'id'        => $line['variant']['data']['product']['data']['id'],
                'name'      => candyAttribute($line['variant']['data']['product']['data'], 'name'),
                'quantity'  => (int) $line['quantity'],
                'thumbnail' => '',//$line['variant']['data']['product']['data']['thumbnail'],
                'variant'   => $line['variant']['data'],
                'total'     => (float) $line['line_total'],
                'slug'      => candyRoute($line['variant']['data']['product']['data'])
            ];

        }

        return $basketData;
    }

    public function update($basketId = '', $request = [])
    {
        $basketIdUrl = '?basket_id=';
        $variants = [];

        if (!empty($basketId)) {
            $basketIdUrl .= $basketId;
        }

        // Format variants
        foreach ($request['basketData']['lines'] as $item) {

            $variants['variants'][] = [
                'id'         => $item['variant']['id'],
                'quantity'   => (int) $item['quantity'],
                'price'      => (float) $item['variant']['price']
            ];

        }
        Log::info($variants);
        // Update Basket
        try {
            $basket = GetCandyClient::Basket($basketIdUrl .'&'. http_build_query($variants))->update();
        } catch(\Exception $e) {
            return $e->getMessage();
        }

        return $basket;
    }

    public function applyDiscount($basketId, $coupon)
    {
        $includes = '&includes=discounts.rewards';
        $url = $basketId .'/discounts?coupon=' . $coupon . $includes;

        $basket = GetCandyClient::Basket($url)->put();

        return $basket;
    }

    public function removeUser($basketId)
    {
        $url = $basketId . '/user';
        $basket = GetCandyClient::Basket($url)->delete();
        return $basket;
    }

    public function addUser($basketId, $userId)
    {
        $url = $basketId . '/user?user_id=' . $userId;
        $basket = GetCandyClient::Basket($url)->put();
        return $basket;
    }

    public function removeDiscount($basketId, $discountId)
    {
        $includes = '&includes=discounts.rewards';
        $url = $basketId .'/discounts?discount_id=' . $discountId . $includes;

        $basket = GetCandyClient::Basket($url)->delete();

        return $basket;
    }
}
