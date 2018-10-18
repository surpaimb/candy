<?php

namespace App\Api\Search\Services;

use Session;
use GetCandyClient;
use App\Api\BaseService;

class SearchService extends BaseService
{

    public function __construct()
    {
        parent::__construct();
    }

    public function get($keywords, $filters, $pagination, $type = 'product', $params = [])
    {
        $params['includes'] = "routes,first_variant";
        $params['type'] = $type;
        $params['currency'] = $this->currency['code'];

        // Set Keywords
        if (isset($keywords)) {
            $params['keywords'] = $keywords;
        }

        // Set Filters
        if (isset($filters)) {
            foreach ($filters as $appliedFilter) {
                $params['filters']['categories']['values'][] = $appliedFilter['value'];
            }
        }

        // Set Records Per Page
        if (isset($pagination['per_page'])) {
            $params['per_page'] = (int) $pagination['per_page'];
        }

        // Set Current Page
        if(isset($pagination['current_page'])) {
            $params['page'] = (int) $pagination['current_page'];
        }

        return GetCandyClient::Products($params)->search();
    }

}
