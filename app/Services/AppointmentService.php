<?php

namespace App\Services;

use App\Models\Appointment;
use App\Models\OfferedService;
use Illuminate\Support\Collection;
use App\Interface\AppointmentRepositoryInterface;

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
        $offeredService = OfferedService::find($data['service_id'])->first(['price' , 'duration_minutes']);
        $data['total_price'] = $offeredService->duration_minutes;
        $data['duration_minutes'] = $offeredService->price;
        return $this->appointmentRepository->createAppointment($data);
    }

    public function updateAppointment(Appointment $appointment, array $data): Appointment
    {
        return $this->appointmentRepository->updateAppointment($appointment, $data);
    }

    public function deleteAppointment(Appointment $appointment): bool
    {
        return $this->appointmentRepository->deleteAppointment($appointment);
    }
}
