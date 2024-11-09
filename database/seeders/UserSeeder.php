<?php

namespace Database\Seeders;

use App\Models\Admin;
use Illuminate\Database\Seeder;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        if (! Admin::where('email', 'admin@beautyqueue.co.za')->exists()) {
            $user = Admin::factory()->create([
                'name' => 'Admin',
                'email' => 'admin@beautyqueue.com',
            ]);

            $user->assignRole('admin');
        }
    }
}
