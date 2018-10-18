<?php

namespace App\Api;

use Carbon\Carbon;
use Session;

abstract class BaseService
{

    public function __construct()
    {
        // If user has selected a currency it will be in a session if not then use config default
        if (Session::has('currency')) {
            $this->currency = Session::get('currency');
        } else {
            $this->currency = [
                'code' => env('CURRENCY_CODE', 'GBP'),
                'symbol' => env('CURRENCY_SYMBOL', '£')
            ];
        }

        if (Session::has('language')) {
            $this->language = Session::get('language');
        } else {
            $this->language = env('APP_LANGUAGE', 'en');
        }
    }

}
