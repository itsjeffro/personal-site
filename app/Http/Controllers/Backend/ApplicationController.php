<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;
use App\Itsjeffro\OauthClient;
use Illuminate\Support\Facades\Auth;
use App\User;

class ApplicationController extends Controller
{
    /** @var User */
    private $user;

    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct(User $user)
    {
        $this->user = $user;
    }

    /**
     * List records.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index()
    {
        $user = $this->user::find(Auth::id());
        $clients = OauthClient::where(['user_id' => $user->id]);
        
        if ($user->hasRole('admin')) {
            $clients->orWhereNull('user_id');
        }

        return view('backend/applications/list')->with([
            'clients' => $clients->get(),
        ]);
    }
}
