<?php

namespace App\Interface;

use App\Models\OfferedService;
use Illuminate\Database\Eloquent\Collection;

interface OfferedServiceRepositoryInterface
{
    /**
     * Get all services for a tenant
     */
    public function getAllServices(int $tenantId): Collection;

    /**
     * Get a service by ID
     */
    public function getServiceById(int|string $id): OfferedService;

    /**
     * Get services by category
     */
    public function getServicesByCategory(int $categoryId, int $tenantId): Collection;

    /**
     * Create a new service
     */
    public function createService(array $serviceDetails): OfferedService;

    /**
     * Update an existing service
     */
    public function updateService(array $newDetails, OfferedService $service): OfferedService;

    /**
     * Delete a service
     */
    public function deleteService(OfferedService $service): void;

    /**
     * Get active services for a tenant
     */
    public function getActiveServices(int $tenantId): Collection;
}