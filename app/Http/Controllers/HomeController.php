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
        $user = Auth::user();
        $clients = OauthClient::where(['user_id' => $user->id]);
        
        if ($user->hasRole('admin')) {
            $clients->orWhereNull('user_id');
        }

        return view('home')->with([
            'clients' => $clients->get(),
        ]);
    }
}
