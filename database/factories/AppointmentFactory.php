<?php

namespace Database\Factories;

use App\Enums\AppointmentStatus;
use App\Models\Customer;
use App\Models\Model;
use App\Models\OfferedService;
use App\Models\Staff;
use Illuminate\Database\Eloquent\Factories\Factory;

class AppointmentFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'customer_id' => Customer::inRandomOrder()->first()->id,
            'staff_id' => Staff::inRandomOrder()->first()->id,
            'offered_service_id' => OfferedService::inRandomOrder()->first()->id,
            'status' => $this->faker->randomElement(AppointmentStatus::cases())->value,
            'appointment_date' => $this->faker->dateTimeBetween('now', '+1 month'),
        ];
    }
}
