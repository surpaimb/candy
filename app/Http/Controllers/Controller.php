<?php

namespace App\Http\Controllers;

use Illuminate\Foundation\Bus\DispatchesJobs;
use Illuminate\Routing\Controller as BaseController;
use Illuminate\Foundation\Validation\ValidatesRequests;
use Illuminate\Foundation\Auth\Access\AuthorizesRequests;
use Illuminate\Support\Facades\Mail;
use Session;

class Controller extends BaseController
{
    use AuthorizesRequests, DispatchesJobs, ValidatesRequests;

    public function __construct()
    {
        $this->data = [];

        $this->middleware(function ($request, $next) {
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

            view()->share([
                'loggedIn' => Session::get('logged_in'),
                'current_user' => Session::get('user'),
                'currency' => $this->currency,
                'language' => $this->language,
            ]);

            return $next($request);
        });
    }

}
