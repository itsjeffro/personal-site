<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;
use App\User;

class UsersController extends Controller
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
        $this->middleware('auth');
        $this->user = $user;
    }

    /**
     * Show records.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index()
    {
        return view('backend.users.list')->with([
            'users' => $this->user->paginate(),
        ]);
    }
}
