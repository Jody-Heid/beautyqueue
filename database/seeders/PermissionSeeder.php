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
            // Hairstylist permissions
            'view_hairstylist',
            'create_hairstylist',
            'update_hairstylist',
            'delete_hairstylist',
            'view_any_hairstylist',
            'update_any_hairstylist',

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
        ];

        foreach ($permissions as $permission) {
            if (! Permission::where('name', $permission)->exists()) {
                Permission::updateOrCreate(['name' => $permission]);
            }

        }
    }
}
