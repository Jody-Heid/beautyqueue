<?php

namespace App\Services;

use App\Interface\OfferedServiceRepositoryInterface;
use App\Models\OfferedService;
use Illuminate\Database\Eloquent\Collection;

class OfferedServiceService
{
    public function __construct(
        private readonly OfferedServiceRepositoryInterface $offeredServiceRepository
    ) {
    }

    /**
     * List all services for a tenant.
     */
    public function listServices(int $tenantId): Collection
    {
        return $this->offeredServiceRepository->getAllServices($tenantId);
    }

    /**
     * Create a new service.
     */
    public function createService(array $serviceData): OfferedService
    {
        if (isset($serviceData['duration']) && !isset($serviceData['duration_minutes'])) {
            $serviceData['duration_minutes'] = $this->convertToMinutes($serviceData['duration']);
            unset($serviceData['duration']);
        }

        return $this->offeredServiceRepository->createService($serviceData);
    }

    /**
     * Get a specific service by ID.
     */
    public function getServiceById(string|int $id): OfferedService
    {
        return $this->offeredServiceRepository->getServiceById($id);
    }

    /**
     * Get services by category.
     */
    public function getServicesByCategory(int $categoryId, int $tenantId): Collection
    {
        return $this->offeredServiceRepository->getServicesByCategory($categoryId, $tenantId);
    }

    /**
     * Update an existing service.
     */
    public function updateService(array $serviceData, OfferedService $service): OfferedService
    {
        // Handle duration conversion if provided
        if (isset($serviceData['duration']) && !isset($serviceData['duration_minutes'])) {
            $serviceData['duration_minutes'] = $this->convertToMinutes($serviceData['duration']);
            unset($serviceData['duration']);
        }

        return $this->offeredServiceRepository->updateService($serviceData, $service);
    }

    /**
     * Delete a specific service.
     */
    public function destroyService(OfferedService $service): void
    {
        $this->offeredServiceRepository->deleteService($service);
    }

    /**
     * Get active services for a tenant.
     */
    public function getActiveServices(int $tenantId): Collection
    {
        return $this->offeredServiceRepository->getActiveServices($tenantId);
    }

    /**
     * Convert duration string to minutes.
     */
    private function convertToMinutes(string $duration): int
    {
        if (preg_match('/^(\d+)h\s*(\d*)?m?$/', $duration, $matches)) {
            $hours = (int) $matches[1];
            $minutes = isset($matches[2]) ? (int) $matches[2] : 0;
            return ($hours * 60) + $minutes;
        }

        if (preg_match('/^(\d+)m$/', $duration, $matches)) {
            return (int) $matches[1];
        }

        return 0;
    }
}