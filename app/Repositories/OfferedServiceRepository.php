<?php

namespace App\Repositories;

use App\Interface\OfferedServiceRepositoryInterface;
use App\Models\OfferedService;
use Illuminate\Database\Eloquent\Collection;

class OfferedServiceRepository implements OfferedServiceRepositoryInterface
{
    /**
     * Gets all services
     */
    public function getAllOfferedServices(): Collection
    {
        return OfferedService::all();
    }

    /**
     * Retrieve a OfferedService model instance by id
     */
    public function getOfferedServiceById(int|string $id): OfferedService
    {
        return OfferedService::find($id);
    }

    /**
     * Create a new OfferedService
     */
    public function createOfferedService(array $offeredServiceDetails): OfferedService
    {
        return OfferedService::create($offeredServiceDetails);
    }

    /**
     * Update an existing OfferedService
     */
    public function updateOfferedService(array $newDetails, OfferedService $offeredService): OfferedService
    {
        $offeredService->update($newDetails);
        $offeredService->refresh();

        return $offeredService;
    }

    /**
     * Remove an existing OfferedService
     */
    public function deleteOfferedService(OfferedService $offeredService): void
    {
        $offeredService->delete();
    }
}
