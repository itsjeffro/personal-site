<?php

namespace App\Http\Controllers;

use App\Itsjeffro\OauthClient;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class SettingsProfileController extends Controller
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
    public function show()
    {
        return view('settings.profile-show')->with([
            'user' => Auth::user(),
        ]);
    }
}
