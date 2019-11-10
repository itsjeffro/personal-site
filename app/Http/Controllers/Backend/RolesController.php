<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;
use App\Itsjeffro\UserRole;
use Spatie\Permission\Models\Permission;
use Spatie\Permission\Models\Role;
use Illuminate\Database\Connection as DB;

class RolesController extends Controller
{
    /** @var Role */
    private $role;

    /** @var DB */
    private $db;

    /**
     * Create a new controller instance.
     *
     * @param Role $role
     * @param DB $db
     * @return void
     */
    public function __construct(Role $role, DB $db)
    {
        $this->role = $role;
        $this->db = $db;
    }

    /**
     * Show records.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index()
    {
        $userRole = new UserRole($this->db);
        $userCountPerRole = $userRole->countPerRole();

        return view('backend.roles.list')->with([
            'roles' => $this->role->paginate(),
            'userCountPerRole' => $userCountPerRole,
        ]);
    }

    /**
     * Show record.
     *
     * @param Role $role
     * @return void
     */
    public function show(Role $role)
    {
        $permissions = Permission::orderBy('name', 'desc')->get();

        return view('backend.roles.show')->with([
            'role' => $role,
            'permissions' => $permissions,
        ]);
    }
}
