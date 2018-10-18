<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Http\Requests\ResetPasswordRequest;
use GetCandyClient;

class ResetPasswordController extends Controller
{
    public function __construct()
    {
        parent::__construct();
    }

    public function index($token = '')
    {
        return view('auth/passwords/reset')
            ->with('token', $token);
    }

    public function resetPassword(ResetPasswordRequest $request)
    {
        try {
            $response = GetCandyClient::Auth()->resetPassword($request->only(['email','password','password_confirmation','token']));
        } catch(\Exception $e) {
            return back()->withErrors(json_decode($e->getResponse()->getBody()->getContents()))->withInput();
        }

        return redirect('/account')
            ->with($response);
    }

}
