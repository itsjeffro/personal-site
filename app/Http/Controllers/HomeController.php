<?php

namespace App\Http\Controllers;

class HomeController
{
    /**
     * Application entry point.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index()
    {
        return view('home');
    }
}
