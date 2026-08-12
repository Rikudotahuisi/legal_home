<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        // $this->middleware('auth');
    }

    public function index()
    {
        return view('home.home');
    }
    public function legality()
    {
        return view ('home.legalitas');
    }
    public function contact()
    {
        return view ('home.contact');
    }
    public function about()
    {
        return view ('home.about');
    }
    public function login()
    {
        return view ('login');
    }
}
