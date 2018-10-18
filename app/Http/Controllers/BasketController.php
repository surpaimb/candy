<?php

namespace App\Http\Controllers;

use App\Http\Requests\Request;

use App\Api\Basket\Services\BasketService;

use GetCandyClient;
use Session;

class BasketController extends Controller
{
    protected $baskets;

    public function __construct(BasketService $baskets)
    {
        parent::__construct();

        $this->baskets = $baskets;
    }

    public function show()
    {
        // Show Basket page
        return view('basket');
    }

    public function get()
    {
        // Get Basket contents
        $basket = $this->baskets->get(Session::get('basket_id'));
        return response()->json($basket);
    }

    public function update(Request $request)
    {
        $basketId = Session::get('basket_id');

        // Find and update basket
        $basket = $this->baskets->update($basketId, $request);

        return response()->json($basket);
    }

    public function discount(Request $request)
    {
        $basketId = Session::get('basket_id');

        try {
            $basket = $this->baskets->applyDiscount($basketId, $request->discountCode);
        } catch (\Exception $e) {
            $response  = $e->getResponse();
            return response([
                'errors' => json_decode($response->getBody()->getContents())->coupon
            ], 422);
        }

        return response()->json($basket);
    }

    public function removeDiscount(Request $request)
    {
        $basketId = Session::get('basket_id');

        try {
            $basket = $this->baskets->removeDiscount($basketId, $request->discountId);
        } catch (\Exception $e) {
            $response  = $e->getResponse();
            return response([
                'errors' => json_decode($response->getBody()->getContents())
            ], 422);
        }

        return response()->json($basket);
    }

}
