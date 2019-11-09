<?php

use Illuminate\Database\Seeder;
use Spatie\Permission\Models\Permission;
use Spatie\Permission\Models\Role;

class RolesTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Permission::insert([
            ['name' => 'users:get', 'guard_name' => 'web'],
            ['name' => 'users:list', 'guard_name' => 'web'],
            ['name' => 'users:create', 'guard_name' => 'web'],
            ['name' => 'users:update', 'guard_name' => 'web'],
            ['name' => 'users:delete', 'guard_name' => 'web'],
            ['name' => 'roles:get', 'guard_name' => 'web'],
            ['name' => 'roles:list', 'guard_name' => 'web'],
            ['name' => 'roles:create', 'guard_name' => 'web'],
            ['name' => 'roles:update', 'guard_name' => 'web'],
            ['name' => 'roles:delete', 'guard_name' => 'web'],
        ]);

        Role::create(['name' => 'admin']);
        Role::create(['name' => 'user']);
    }
}
