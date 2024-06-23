<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Seeder;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        if (! User::where('email', 'admin@beautyqueue.com')->exists()) {
            $user = User::factory()->create([
                'name' => 'Admin',
                'email' => 'admin@beautyqueue.com',
            ]);
            $user->assignRole('admin', 'staff');
        }
    }
}
