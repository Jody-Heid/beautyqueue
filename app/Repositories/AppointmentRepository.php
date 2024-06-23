<?php

namespace App\Repositories;

use App\Interface\AppointmentRepositoryInterface;
use App\Models\Appointment;
use App\Models\User;
use Illuminate\Support\Collection;

class AppointmentRepository implements AppointmentRepositoryInterface
{
    /**
     * Gets all Appointments
     */
    public function getAllAppointments(): Collection
    {
        return Appointment::all();
    }

    /**
     * Retrieve an Appointment model instance by id
     */
    public function getAppointmentById(int|string $id): Appointment
    {
        return Appointment::findOrFail($id);
    }

    /**
     * Retrieve an Appointment model instance by User
     */
    public function getUserAppointment(User $user): Collection
    {
        return $user->appointments;
    }

    /**
     * Create a new Appointment
     */
    public function createAppointment(array $appointmentDetails): Appointment
    {
        return Appointment::create($appointmentDetails);
    }

    /**
     * Update an existing Appointment
     */
    public function updateAppointment(array $newDetails, Appointment $appointment): Appointment
    {
        $appointment->update($newDetails);

        return $appointment;
    }

    /**
     * Remove an existing Appointment
     */
    public function deleteAppointment(Appointment $appointment): void
    {
        $appointment->delete();
    }
}
