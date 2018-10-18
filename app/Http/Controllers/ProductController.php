<?php

namespace App\Http\Controllers;

use GetCandyClient;
use App\Http\Requests\Request;
use App\Http\Requests\SearchRequest;

use App\Api\Products\Services\ProductService;
class ProductController extends Controller
{
    protected $products;

    public function __construct(ProductService $products)
    {
        parent::__construct();

        $this->products = $products;
    }

    public function show($slug)
    {
        $product = $this->products->getBySlug($slug);

        if (!$product) {
            return abort(404);
        }

        return view('product')->with('product', $product);
    }

    public function get(Request $request, $productId)
    {
        $product = $this->products->get($productId);

        return response()->json($product);
    }
}
