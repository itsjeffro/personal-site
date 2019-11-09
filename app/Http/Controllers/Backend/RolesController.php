<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;
use Spatie\Permission\Models\Permission;
use Spatie\Permission\Models\Role;

class RolesController extends Controller
{
    /** @var Role */
    private $role;

    /**
     * Create a new controller instance.
     *
     * @param Role $role
     * @return void
     */
    public function __construct(Role $role)
    {
        $this->middleware('auth');
        $this->role = $role;
    }

    /**
     * Show records.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index()
    {
        return view('backend.roles.list')->with([
            'roles' => $this->role->paginate(),
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
