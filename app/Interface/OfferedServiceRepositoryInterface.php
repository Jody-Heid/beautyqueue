<?php

namespace App\Interface;

use App\Models\OfferedService;
use Illuminate\Database\Eloquent\Collection;

interface OfferedServiceRepositoryInterface
{
    /**
     * Gets all services
     */
    public function getAllOfferedServices(): Collection;

    /**
     * Retrieve a OfferedService model instance by id
     */
    public function getOfferedServiceById(int|string $id): OfferedService;

    /**
     * Create a new OfferedService
     */
    public function createOfferedService(array $offeredServiceDetails): OfferedService;

    /**
     * Update an existing OfferedService
     */
    public function updateOfferedService(array $newDetails, OfferedService $offeredService): OfferedService;

    /**
     * Remove an existing OfferedService
     */
    public function deleteOfferedService(OfferedService $offeredService): void;
}
