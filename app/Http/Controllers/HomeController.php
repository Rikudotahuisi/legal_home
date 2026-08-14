<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Inertia\Inertia;


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
        return inertia::render('home/Index');
    }
    public function legality()
    {
        return inertia::render('home/Legality');
    }
    public function contact()
    {
        return inertia::render('home/Contact');
    }
    public function about()
    {
        return inertia::render('home/About');
    }
    public function artikel()
    {
        return inertia::render('home/Artikel');
    }
    public function galery()
    {
        return inertia::render('home/Galery');
    }
    public function login()
    {
        return view ('auth/login');
    }
}
