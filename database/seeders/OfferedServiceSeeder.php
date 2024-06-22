<?php

namespace Database\Seeders;

use App\Models\OfferedService;
use Illuminate\Database\Seeder;

class OfferedServiceSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        OfferedService::factory(10)->create();
    }
}
