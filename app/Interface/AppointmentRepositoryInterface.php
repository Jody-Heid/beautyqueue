<?php

namespace App\Interface;

use App\Enums\AppointmentStatus;
use App\Models\Appointment;
use App\Models\Customer;
use App\Models\Hairstylist;
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
     * Retrieve a Appointment model instance by Customer
     */
    public function getCustomerAppointments(Customer $customer): ?Collection;

    /**
     * Retrieve a Appointment model instance by Hairstylist
     */
    public function getStaffAppointments(Hairstylist $hairstylist): ?Collection;

    /**
     * Create a new Appointment
     */
    public function createAppointment(array $userDetails, ?Customer $customer = null, ?Hairstylist $hairstylist = null): Appointment;

    /**
     * Update an existing Appointment
     */
    public function updateAppointment(array $newDetails, Appointment $appointment): Appointment;

    /**
     * Update an existing Appointment status
     */
    public function updateAppointmentStatus(AppointmentStatus $status, Appointment $appointment): Appointment;

    /**
     * Remove an existing Appointment
     */
    public function deleteAppointment(Appointment $appointment): void;
}
