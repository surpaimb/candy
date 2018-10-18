<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Http\Requests\LoginRequest;

use App\Api\Auth\Services\UserService;
use App\Api\Basket\Services\BasketService;

use GuzzleHttp\Exception\ClientException;
use Session;
use Auth;
use GetCandyClient;

class LoginController extends Controller
{
    protected $baskets;
    protected $users;

    public function __construct(BasketService $baskets, UserService $users)
    {
        parent::__construct();

        $this->baskets = $baskets;
        $this->users = $users;
    }

    public function index()
    {
        return view('auth/login');
    }

    public function login(LoginRequest $request)
    {
        try {
            $this->users->login($request->only(['email','password']));
        } catch(\Exception $e) {
            if ($request->ajax()) {
                return response()->json(json_decode($e->getResponse()->getBody()->getContents()), 400);
            }else {
                return back()->withErrors(json_decode($e->getResponse()->getBody()->getContents()))->withInput();
            }
        }
        $user = $this->users->current();

        // If we have a basket, attach it to the current user...
        if (Session::has('basket_id')) {
            $this->baskets->addUser(
                Session::get('basket_id'),
                $user['data']['id']
            );
        }

        if ($request->ajax()) {
            return response()->json(['message' => 'Successfully logged in'], 200);
        } else {
            return redirect('/account')->with('status', 'Successfully logged in');
        }
    }

    public function logout()
    {
        if (Session::has('basket_id')) {
            $this->baskets->removeUser(
                Session::get('basket_id'),
                Session::get('user')['id']
            );
        }

        $this->users->logout();

        return redirect('/')->with('status', 'Successfully logged out');
    }
}
