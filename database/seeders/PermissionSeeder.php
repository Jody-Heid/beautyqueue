<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Spatie\Permission\Models\Permission;

class PermissionSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $permissions = [
            'view services',
            'book appointments',
            'view own appointments',
            'write reviews',
            'edit own profile',
            'view schedule',
            'manage availability',
            'provide services',
            'view reviews',
            'manage own services',
            'create appointments',
            'manage users',
            'manage roles',
            'manage services',
            'view all appointments',
            'manage reviews',
            'view system settings',
        ];

        foreach ($permissions as $permission) {
            if (! Permission::where('name', $permission)->exists()) {
                Permission::updateOrCreate(['name' => $permission]);
            }

        }
    }
}
