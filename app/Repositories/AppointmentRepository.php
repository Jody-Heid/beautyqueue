<?php

namespace App\Repositories;

use App\Interface\AppointmentRepositoryInterface;
use App\Models\Appointment;
use Illuminate\Support\Collection;

class AppointmentRepository implements AppointmentRepositoryInterface
{
    public function getAllAppointments(): ?Collection
    {
        return Appointment::all();
    }

    public function findByAppointmentId(int $id): ?Appointment
    {
        return Appointment::find($id);
    }

    public function findByAppointmentTenantId(int $tenantId): Collection
    {
        return Appointment::where('tenant_id', $tenantId)->get();
    }

    public function findByAppointmentUserId(int $userId): Collection
    {
        return Appointment::where('user_id', $userId)->get();
    }

    public function createAppointment(array $data): Appointment
    {
        return Appointment::create($data);
    }

    public function updateAppointment(Appointment $appointment, array $data): bool
    {
        return $appointment->update($data);
    }

    public function deleteAppointment(Appointment $appointment): bool
    {
        return $appointment->delete();
    }
}
