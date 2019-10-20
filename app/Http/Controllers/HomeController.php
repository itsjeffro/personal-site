<?php

namespace App\Http\Controllers;

use App\Itsjeffro\OauthClient;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index()
    {
        $userId = Auth::id();
        $clients = OauthClient::where(['user_id' => $userId])->get();

        return view('home')->with([
            'clients' => $clients,
        ]);
    }
}
