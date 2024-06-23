<?php

namespace App\Interface;

use App\Models\Appointment;
use App\Models\User;
use Illuminate\Support\Collection;

interface AppointmentRepositoryInterface
{
    /**
     * Gets all Appointments
     */
    public function getAllAppointments(): Collection;

    /**
     * Retrieve a Appointment model instance by id
     */
    public function getAppointmentById(int|string $id): Appointment;

    /**
     * Retrieve a Appointment model instance by User
     */
    public function getUserAppointment(User $user): Collection;

    /**
     * Create a new Appointment
     */
    public function createAppointment(array $userDetails): Appointment;

    /**
     * Update an existing Appointment
     */
    public function updateAppointment(array $newDetails, Appointment $appointment): Appointment;

    /**
     * Remove an existing Appointment
     */
    public function deleteAppointment(Appointment $appointment): void;
}
