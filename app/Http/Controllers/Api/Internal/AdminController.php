<?php

namespace App\Http\Controllers\Api\Internal;

use App\AmxAdmin as Admin;
use Illuminate\Http\Request;
use App\Http\Resources\Admin as AdminResource;

class AdminController
{
    /** @var Admin */
    private $admin;

    /**
     * AdminController
     *
     * @param Admin $admin
     */
    public function __construct(Admin $admin)
    {
        $this->admin = $admin;
    }

    /**
     * List admins.
     *
     * @return \Illuminate\Http\JsonResponse
     */
    public function index(Request $request)
    {
        $perPage = (int) $request->get('per_page', Admin::DEFAULT_PER_PAGE);

        $admins = $this->admin
            ->with(['player'])
            ->paginate($perPage);

        return AdminResource::collection($admins);
    }

    /**
     * Get admin.
     *
     * @param string $auth
     * @return \Illuminate\Http\JsonResponse
     */
    public function show(string $auth)
    {
        $admin = $this->admin
            ->with(['player', 'playerStats'])
            ->where('auth', $auth)
            ->first();

        if (!$admin instanceof Admin) {
            return response()->json(['message' => sprintf('Admin could not be found with auth [%s]', $auth)], 404);
        }

        return new AdminResource($admin);
    }

    /**
     * Update admin.
     *
     * @param Request $request
     * @param string $auth
     * @return \Illuminate\Http\JsonResponse
     */
    public function update(Request $request, string $auth)
    {
        $admin = $this->admin
            ->where('auth', $auth)
            ->first();

        if (!$admin instanceof Admin) {
            return response()->json(['message' => sprintf('Admin could not be found with auth [%s]', $auth)], 404);
        }

        $admin->password = "test";

        $admin->save();

        return new AdminResource($admin);
    }
}
