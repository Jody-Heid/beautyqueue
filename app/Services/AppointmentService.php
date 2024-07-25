<?php

namespace App\Services;

use App\Enums\AppointmentStatus;
use App\Exceptions\AppointmentStatusException;
use App\Interface\AppointmentRepositoryInterface;
use App\Models\Appointment;
use App\Models\Customer;
use App\Models\Hairstylist;
use App\Models\User;
use Exception;
use Illuminate\Support\Collection;

class AppointmentService
{
    public function __construct(protected AppointmentRepositoryInterface $appointmentRepository)
    {
    }

    /**
     * Gets all Appointments
     */
    public function getAppointments(User $user): ?Collection
    {
        if ($user->admin) {
            return $this->appointmentRepository->getAllAppointments();
        }
        if ($user->hairstylist) {
            return $this->appointmentRepository->getStaffAppointments($user->hairstylist);
        }
        if ($user->customer) {
            return $this->appointmentRepository->getCustomerAppointments($user->customer);
        }

        throw new Exception('Error in getting appointments: ');
    }

    /**
     * Retrieve an Appointment by id
     */
    public function getAppointmentById(int|string $id): Appointment
    {
        return $this->appointmentRepository->getAppointmentById($id);
    }

    /**
     * Create a new Appointment
     */
    public function createAppointment(array $appointmentDetails, ?Customer $customer = null, ?Hairstylist $hairstylist = null): Appointment
    {
        return $this->appointmentRepository->createAppointment($appointmentDetails, $customer, $hairstylist);
    }

    /**
     * Update an existing Appointment
     */
    public function updateAppointment(array $newDetails, Appointment $appointment): Appointment
    {
        return $this->appointmentRepository->updateAppointment($newDetails, $appointment);
    }

    /**
     * Update an existing Appointment status
     *
     * @throws Exception
     */
    public function updateAppointmentStatus(string $status, Appointment $appointment): Appointment
    {
        $status = AppointmentStatus::tryFrom($status);

        if ($status == null) {
            throw new AppointmentStatusException();
        }

        return $this->appointmentRepository->updateAppointmentStatus($status, $appointment);
    }

    /**
     * Remove an existing Appointment
     */
    public function deleteAppointment(Appointment $appointment): void
    {
        $this->appointmentRepository->deleteAppointment($appointment);
    }
}
