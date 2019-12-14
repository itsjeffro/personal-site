<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;
use App\Itsjeffro\OauthClient;
use Illuminate\Support\Facades\Auth;

class ApplicationController extends Controller
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
     * List records.
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

        return view('backend/applications/list')->with([
            'clients' => $clients->get(),
        ]);
    }
}
