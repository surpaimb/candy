<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Http\Requests\RegisterRequest;

use App\Api\Auth\Services\UserService;

use GuzzleHttp\Exception\ClientException;
use GetCandyClient;

class RegisterController extends Controller
{
    protected $users;

    public function __construct(UserService $users)
    {
        parent::__construct();

        $this->users = $users;
    }

    public function index()
    {
        return view('auth/register');
    }

    public function register(RegisterRequest $request)
    {
        $customer = $request->only(['firstname', 'lastname', 'email', 'password', 'password_confirmation', 'language']);
        $customer['group'] = 'retail';

        try {
            $response = GetCandyClient::Customers()->create($customer);
            $this->users->login($request->only(['email','password']));
        } catch (ClientException  $e) {
            return back()->withErrors(json_decode($e->getResponse()->getBody()->getContents()))->withInput();
        }

        return redirect('/account')->with('status', 'Successfully logged in');

    }
}
