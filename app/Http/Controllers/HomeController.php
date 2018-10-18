<?php

namespace App\Http\Controllers;

use GetCandyClient;
use Session;
use App\Http\Requests\Request;

class HomeController extends Controller
{
    public function __construct()
    {
        parent::__construct();
    }

    public function index()
    {
        return view('home');
    }

    public function updateVat(Request $request)
    {
        Session::put('excl_tax', $request->excl_tax);

        return response()->json(Session::get('excl_tax'));
    }

    public function updateCurrency(Request $request)
    {
        Session::put('currency', $request->currency);

        return response()->json(Session::get('currency'));
    }

    public function updateLanguage(Request $request)
    {
        Session::put('language', $request->language);

        return response()->json(Session::get('language'));
    }
}
