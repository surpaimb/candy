<?php

namespace App\Api\Countries\Services;

use GetCandyClient;
use App\Api\BaseService;

class CountryService extends BaseService
{

    public function __construct()
    {
        parent::__construct();
    }

    public function get()
    {

        try {
            $countries = GetCandyClient::Countries()->get();
        } catch(\Exception $e) {
            return $e->getMessage();
        }

        return $countries['data'];

    }

}
