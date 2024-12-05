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
            // Tenant permissions
            'view_tenants',
            'create_tenants',
            'update_tenants',
            'delete_tenants',
            'view_any_tenants',
            'update_any_tenants',

            // User permissions
            'view_user',
            'create_user',
            'update_user',
            'delete_user',
            'view_any_user',
            'update_any_user',

            // Customer permissions
            'view_customer',
            'create_customer',
            'update_customer',
            'delete_customer',
            'view_any_customer',
            'update_any_customer',

            // Offered Service permissions
            'view_services',
            'create_services',
            'update_services',
            'delete_services',

            // Offered Appointments permissions
            'view_appointments',
            'create_appointments',
            'update_appointments',
            'delete_appointments',
            'view_any_appointments',
            'update_any_appointments',
            'delete_any_appointments',

            // Category permissions
            'view_categories',
            'create_categories',
            'update_categories',
            'delete_categories',
            'view_any_categories',
            'update_any_categories',
            'delete_any_categories',

        ];

        foreach ($permissions as $permission) {
            if (! Permission::where('name', $permission)->exists()) {
                Permission::updateOrCreate(['name' => $permission]);
            }
        }
    }
}
