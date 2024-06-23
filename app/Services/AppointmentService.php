<?php

namespace App\Services;

use App\Interface\AppointmentRepositoryInterface;
use App\Models\Appointment;
use App\Models\User;
use Illuminate\Support\Collection;

class AppointmentService
{
    public function __construct(protected AppointmentRepositoryInterface $appointmentRepository)
    {
    }

    /**
     * Gets all Appointments
     */
    public function getAllAppointments(): Collection
    {
        return $this->appointmentRepository->getAllAppointments();
    }

    /**
     * Retrieve an Appointment by id
     */
    public function getAppointmentById(int|string $id): Appointment
    {
        return $this->appointmentRepository->getAppointmentById($id);
    }

    /**
     * Retrieve Appointments by User
     */
    public function getUserAppointments(User $user): Collection
    {
        return $this->appointmentRepository->getUserAppointment($user);
    }

    /**
     * Create a new Appointment
     */
    public function createAppointment(array $appointmentDetails): Appointment
    {
        return $this->appointmentRepository->createAppointment($appointmentDetails);
    }

    /**
     * Update an existing Appointment
     */
    public function updateAppointment(array $newDetails, Appointment $appointment): Appointment
    {
        return $this->appointmentRepository->updateAppointment($newDetails, $appointment);
    }

    /**
     * Remove an existing Appointment
     */
    public function deleteAppointment(Appointment $appointment): void
    {
        $this->appointmentRepository->deleteAppointment($appointment);
    }
}
