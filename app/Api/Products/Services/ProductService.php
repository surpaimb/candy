<?php

namespace App\Api\Products\Services;

use Session;
use GetCandyClient;
use App\Api\BaseService;

class ProductService extends BaseService
{

    public function __construct()
    {
        parent::__construct();
    }

    public function get($productId)
    {
        try {
            $params['currency'] = $this->currency['code'];
            $params['includes'] = 'customer_groups,associations,assets.transforms,categories,assets.tags,variants.product,routes,categories,attribute_groups,attribute_groups.attributes,channels,variants.tiers';
            $product = GetCandyClient::Products($productId.'?'.http_build_query($params))->get();

        } catch(\Exception $e) {
            return $e->getMessage();
        }

        return $product['data'];

    }

    public function getBySlug($slug)
    {
        try {

            $routes = GetCandyClient::Routes($slug.'?includes=element')->get();
            if (!isset($routes['data']['element']['data']['id']) || $routes['data']['type'] !== 'product') {
                return abort(404);
            }

            // Get Product
            $productId = $routes['data']['element']['data']['id'];
            $productParams['currency'] = $this->currency['code'];
            $productParams['includes'] = 'customer_groups,associations,assets.transforms,categories,assets.tags,variants.product,routes,categories.routes,attribute_groups,attribute_groups.attributes,channels,variants.tiers';

            $product = GetCandyClient::Products($productId.'?'.http_build_query($productParams))->get();
        } catch(\Exception $e) {
            return $e->getMessage();
        }

        return $product['data'];

    }

}
