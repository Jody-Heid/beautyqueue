<?php

namespace App\Services;

use App\Interface\OfferedServiceRepositoryInterface;
use App\Models\OfferedService;
use Illuminate\Database\Eloquent\Collection;

class OfferedServiceService
{
    public function __construct(
        protected OfferedServiceRepositoryInterface $offeredServiceRepository
    ) {
    }

    /**
     * Get all offered services.
     */
    public function getAllOfferedServices(): Collection
    {
        return $this->offeredServiceRepository->getAllOfferedServices();
    }

    /**
     * Create a new offered service.
     */
    public function createOfferedService(array $data): OfferedService
    {
        return $this->offeredServiceRepository->createOfferedService($data);
    }

    /**
     * Get an offered service by ID.
     */
    public function getOfferedServiceById(int|string $id): OfferedService
    {
        return $this->offeredServiceRepository->getOfferedServiceById($id);
    }

    /**
     * Update an existing offered service.
     */
    public function updateOfferedService(array $data, OfferedService $service): OfferedService
    {
        return $this->offeredServiceRepository->updateOfferedService($data, $service);
    }

    /**
     * Delete an offered service.
     */
    public function deleteOfferedService(OfferedService $service): void
    {
        $this->offeredServiceRepository->deleteOfferedService($service);
    }
}
