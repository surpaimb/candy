<?php

namespace App\Http\Controllers;

class PageController extends Controller
{
    public function __construct()
    {
        parent::__construct();
    }

    public function index($view)
    {
        if(view()->exists('pages/'. $view)){
            return view('pages/'. $view)->render();
        }
        return abort(404);
    }
}
