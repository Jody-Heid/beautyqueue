<?php

namespace App\Services;

use App\Interface\AppointmentRepositoryInterface;
use App\Models\Appointment;
use Illuminate\Support\Collection;

class AppointmentService
{
    public function __construct(protected AppointmentRepositoryInterface $appointmentRepository)
    {
    }

    public function getAppointments(): ?Collection
    {
        return $this->appointmentRepository->getAllAppointments();
    }

    public function getAppointmentById(int $id): ?Appointment
    {
        return $this->appointmentRepository->findByAppointmentId($id);
    }

    public function getAppointmentsByTenantId(int $tenantId): Collection
    {
        return $this->appointmentRepository->findByAppointmentTenantId($tenantId);
    }

    public function getAppointmentsByUserId(int $userId): Collection
    {
        return $this->appointmentRepository->findByAppointmentUserId($userId);
    }

    public function createAppointment(array $data): Appointment
    {
        return $this->appointmentRepository->createAppointment($data);
    }

    public function updateAppointment(Appointment $appointment, array $data): bool
    {
        return $this->appointmentRepository->updateAppointment($appointment, $data);
    }

    public function deleteAppointment(Appointment $appointment): bool
    {
        return $this->appointmentRepository->deleteAppointment($appointment);
    }
}
