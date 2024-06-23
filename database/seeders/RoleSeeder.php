<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Spatie\Permission\Models\Permission;
use Spatie\Permission\Models\Role;

class RoleSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {

        $roles = collect([
            'admin' => Permission::all(),
            'staff' => [],
            'customer' => ['view services', 'book appointments', 'view own appointments', 'write reviews', 'edit own profile'],
            'hairstylist' => ['view schedule', 'manage availability', 'provide services', 'view reviews', 'edit own profile', 'manage own services', 'create appointments'],
        ]);

        foreach ($roles as $role => $permission) {
            if (! Role::where('name', $role)->exists()) {
                $roleRecord = Role::create(['name' => $role]);
                $roleRecord->givePermissionTo($permission);
            }

        }
    }
}
