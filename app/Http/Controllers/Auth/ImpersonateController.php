<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

use App\Api\Auth\Services\UserService;

use GetCandyClient;
use Session;

class ImpersonateController extends Controller
{
    protected $users;

    public function __construct(UserService $users)
    {
        parent::__construct();

        $this->users = $users;
    }

    public function store($token, Request $request)
    {
        $this->users->logout();
        $login = $this->users->loginWithToken($token);
        Session::put('impersonating', true);
        return redirect('/');
    }
}
