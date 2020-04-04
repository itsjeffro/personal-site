<?php

namespace App\Http\Controllers\Api\Internal;

use App\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;
use Illuminate\Http\RedirectResponse;

class UserController
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
     * @return JsonResponse
     */
    public function index()
    {
        return response()->json($this->user->paginate());
    }

    /**
     * Create record.
     *
     * @param Request $request
     * @return JsonResponse
     */
    public function store(Request $request)
    {
        $validator = $this->validator::make($request->all(), [
            'name' => 'required',
            'email' => 'required|email|unique:users',
            'password' => 'required|confirmed|min:8',
        ]);

        if ($validator->fails()) {
            return response()->json([], 422);
        }

        $user = $this->user->create([
            'name' => $request->input('name'),
            'email' => $request->input('email'),
            'password' => $this->hash::make($request->input('password')),
        ]);

        return response()->json($user, 201);
    }
    
    /**
     * Show record.
     *
     * @param User $user
     * @return JsonResponse
     */
    public function show(User $user)
    {
        return response()->json($user);
    }

    /**
     * Update record.
     *
     * @param Request $request
     * @param User $user
     * @return JsonResponse
     */
    public function update(Request $request, User $user)
    {
        return response()->json($user);
    }
}
