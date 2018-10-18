<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Http\Requests\ForgottenPasswordRequest;
use GetCandyClient;

use Illuminate\Support\Facades\Mail;
use App\Mail\ResetPassword;

class ForgottenPasswordController extends Controller
{
    public function index()
    {
        return view('auth/passwords/email');
    }

    public function sendReset(ForgottenPasswordRequest $request)
    {
        $params['email'] = $request->email;
        $params['return'] = env('APP_URL', '');

        try {
            $response = GetCandyClient::Auth()->forgottenPassword($params);
        } catch(\Exception $e) {
            return back()->withErrors(json_decode($e->getResponse()->getBody()->getContents()))->withInput();
        }

        if ($response['success']) {
            Mail::to($request->email)->send(new ResetPassword($response['success']['message']['token'], env('APP_URL', '')));
            return redirect('/password/reset/');
        }

        return back();
    }
}
