<?php

namespace App\Interface;

use App\Models\Appointment;
use Illuminate\Support\Collection;

interface AppointmentRepositoryInterface
{
    public function getAllAppointments(): ?Collection;

    public function findByAppointmentId(int $id): ?Appointment;

    public function findByAppointmentTenantId(int $tenantId): Collection;

    public function findByAppointmentUserId(int $userId): Collection;

    public function createAppointment(array $data): Appointment;

    public function updateAppointment(Appointment $appointment, array $data): Appointment;

    public function deleteAppointment(Appointment $appointment): bool;
}
