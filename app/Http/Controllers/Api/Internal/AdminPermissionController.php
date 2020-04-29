<?php

namespace App\Http\Controllers\Api\Internal;

use App\Game\Amx\AdminPermission;
use App\Player;
use Illuminate\Http\Request;
use App\Http\Resources\Admin as AdminResource;

class AdminPermissionController
{
    /**
     * List admin related permissions.
     *
     * @return \Illuminate\Http\JsonResponse
     */
    public function index()
    {
        return response()->json([
            'access' => AdminPermission::ACCESS,
            'flags' => AdminPermission::FLAGS,
        ]);
    }
}
