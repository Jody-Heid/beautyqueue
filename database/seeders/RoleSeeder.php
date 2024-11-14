<?php

namespace Database\Seeders;

use App\Enums\UserRoles;
use Illuminate\Database\Seeder;
use Spatie\Permission\Models\Role;

class RoleSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {

        foreach (UserRoles::all() as $role) {
            if (! Role::where('name', $role)->exists()) {
                Role::create(['name' => $role, 'guard_name' => 'api']);
            }
        }
    }
}
