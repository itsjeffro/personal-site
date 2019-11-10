<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;
use App\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;
use Illuminate\Http\RedirectResponse;

class UsersController extends Controller
{
    /** @var User */
    private $user;

    /** @var Validator */ 
    private $validator;

    /** @var Hash */
    private $hash;

    /**
     * UsersController.
     *
     * @param User $user
     * @param Validator $validator
     * @param Hash $hash
     */
    public function __construct(User $user, Validator $validator, Hash $hash)
    {
        $this->user = $user;
        $this->validator = $validator;
        $this->hash = $hash;
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
    
    /**
     * Show create form.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function create()
    {
        return view('backend.users.create');
    }

    /**
     * Create record.
     *
     * @param Request $request
     * @return RedirectResponse
     */
    public function store(Request $request)
    {
        $validator = $this->validator::make($request->all(), [
            'name' => 'required',
            'email' => 'required|email|unique:users',
            'password' => 'required|confirmed|min:8',
        ]);

        if ($validator->fails()) {
            return redirect()
                ->route('users.create')
                ->withErrors($validator)
                ->withInput();
        }

        $this->user->create([
            'name' => $request->input('name'),
            'email' => $request->input('email'),
            'password' => $this->hash::make($request->input('password')),
        ]);

        return redirect()->route('users.list');
    }
    
    /**
     * Show record.
     *
     * @param User $user
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function show(User $user)
    {
        return view('backend.users.show')->with([
            'user' => $user,
            'roles' => $user->getRoleNames()->implode(', '),
        ]);
    }

    /**
     * Update record.
     *
     * @param Request $request
     * @param User $user
     * @return RedirectResponse
     */
    public function update(Request $request, User $user)
    {
        return redirect()->route('backend.users.show');
    }
}
