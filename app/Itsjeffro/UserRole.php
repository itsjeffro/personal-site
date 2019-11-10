<?php

namespace App\Itsjeffro;

use Illuminate\Database\Connection as DB;

class UserRole
{
    /** @var DB */
    private $db;

    /**
     * @param DB $db
     */
    public function __construct(DB $db)
    {
        $this->db = $db;
    }

    /**
     * Return user count per role.
     *
     * @return integer[]
     */
    public function countPerRole(): array
    {
        $modelHasRoles = $this->db
            ->table('model_has_roles')
            ->selectRaw('COUNT(*) as total_users, role_id')
            ->where('model_type', 'App\User')
            ->groupBy('role_id')
            ->get();

        $userCountPerRole = [];

        foreach ($modelHasRoles as $modelHasRole) {
            $userCountPerRole[$modelHasRole->role_id] = $modelHasRole;
        }

        return $userCountPerRole;
    }
}
