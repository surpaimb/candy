<?php

namespace App\Api\Auth\Services;

use GetCandyClient;
use Session;
use Config;
use App\Api\BaseService;
use Carbon\Carbon;

class UserService extends BaseService
{

    public function __construct()
    {
        parent::__construct();
    }

    public function login($credentials)
    {
        $params['username'] = $credentials['email'];
        $params['password'] = $credentials['password'];
        $params['grant_type'] = 'password';
        $params['client_id'] = Config::get('services.ecommerce_api.client_id');
        $params['client_secret'] = Config::get('services.ecommerce_api.client_secret');

        if (!$token = GetCandyClient::Auth()->post($params)) {
            return false;
        }

        $this->loginWithToken(
            $token['access_token'],
            $token['refresh_token'],
            $token['expires_in']
        );

        Session::forget('order_id');

        return true;
    }

    /**
     * Login with a token
     *
     * @param string $token
     *
     * @return void
     */
    public function loginWithToken($token, $refresh = null, $expires = null)
    {
        if ($expires) {
            $dateTime = Carbon::now()->addSeconds($expires);
        } else {
            $dateTime = Carbon::now()->addMinutes(
                config('session.lifetime')
            );
        }

        Session::put('api_token_expiry', $dateTime);
        Session::put('api_token', $token);

        if ($refresh) {
            Session::put('api_refresh_token', $refresh);
        }

        Session::put('logged_in', true);
    }

    public function logout()
    {
        Session::forget('api_token_expiry');
        Session::forget('api_token');
        Session::forget('api_refresh_token');
        Session::forget('logged_in');
        Session::forget('user');
        Session::forget('impersonating');
    }

    public function current()
    {
        if (!Session::get('logged_in')) {
            return [];
        }
        $params['includes'] = 'addresses,groups,roles';

        try {
            $response = GetCandyClient::Users()->current($params);
            Session::put('user', $response['data']);
        } catch (\Exception $e) {
            Session::forget('api_token_expiry');
            Session::forget('api_token');
            Session::forget('api_refresh_token');
            Session::forget('logged_in');
            Session::forget('order_id');
            Session::forget('user');
            $response = [];
        }

        return $response;
    }

    public function update($userId, $data)
    {
        $response = GetCandyClient::Users()->put($userId .'?'. http_build_query($data));
        return $response;
    }

}
