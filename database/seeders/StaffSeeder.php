<?php

namespace Database\Seeders;

use App\Models\Staff;
use Illuminate\Database\Seeder;

class StaffSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        if (! Staff::where('email', 'admin@beautyqueue.co.za')->exists()) {
            $user = Staff::factory()->create([
                'name' => 'Admin',
                'email' => 'admin@beautyqueue.com',
            ]);

            $user->assignRole('admin');
        }
    }
}
