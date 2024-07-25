<?php

namespace App\Repositories;

use App\Enums\AppointmentStatus;
use App\Interface\AppointmentRepositoryInterface;
use App\Models\Appointment;
use App\Models\Customer;
use App\Models\Hairstylist;
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
     * Retrieve an Appointment model instance by Custome
     */
    public function getCustomerAppointments(Customer $customer): ?Collection
    {
        return $customer->customerAppointments;
    }

    /**
     * Retrieve an Appointment model instance by Hairstylist
     */
    public function getStaffAppointments(Hairstylist $hairstylist): ?Collection
    {
        return $hairstylist->staffAppointments;
    }

    /**
     * Create a new Appointment
     */
    public function createAppointment(array $appointmentDetails, ?Customer $customer = null, ?Hairstylist $hairstylist = null): Appointment
    {
        $appointment = Appointment::create([
            'customer_id' => $customer->id ?? $appointmentDetails['customer_id'],
            'staff_id' => $hairstylist->id ?? $appointmentDetails['staff_id'] ?? null,
            'offered_service_id' => $appointmentDetails['offered_service_id'],
            'appointment_date' => $appointmentDetails['appointment_date'],
            'appointment_time' => $appointmentDetails['appointment_time'],
        ]);

        $appointment->refresh();

        return $appointment;
    }

    /**
     * Update an existing Appointment
     */
    public function updateAppointment(array $newDetails, Appointment $appointment): Appointment
    {
        $appointment->update($newDetails);
        $appointment->refresh();

        return $appointment;
    }

    /**
     * Update an existing Appointment status
     */
    public function updateAppointmentStatus(AppointmentStatus $status, Appointment $appointment): Appointment
    {
        $appointment->update(['status' => $status->value]);

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
