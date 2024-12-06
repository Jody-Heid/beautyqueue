<?php

namespace App\Repositories;

use App\Interface\OfferedServiceRepositoryInterface;
use App\Models\OfferedService;
use Illuminate\Database\Eloquent\Collection;

class OfferedServiceRepository implements OfferedServiceRepositoryInterface
{
    public function getAllServices(int $tenantId): Collection
    {
        return OfferedService::where('tenant_id', $tenantId)
            ->with('category')
            ->orderBy('name')
            ->get();
    }

    public function getServiceById(int|string $id): OfferedService
    {
        return OfferedService::with('category')->findOrFail($id);
    }

    public function getServicesByCategory(int $categoryId, int $tenantId): Collection
    {
        return OfferedService::where('tenant_id', $tenantId)
            ->where('category_id', $categoryId)
            ->where('is_active', true)
            ->orderBy('name')
            ->get();
    }

    public function createService(array $serviceDetails): OfferedService
    {
        return OfferedService::create($serviceDetails);
    }

    public function updateService(array $newDetails, OfferedService $service): OfferedService
    {
        $service->update($newDetails);
        $service->refresh();

        return $service;
    }

    public function deleteService(OfferedService $service): void
    {
        $service->delete();
    }

    public function getActiveServices(int $tenantId): Collection
    {
        return OfferedService::where('tenant_id', $tenantId)
            ->where('is_active', true)
            ->with('category')
            ->orderBy('name')
            ->get();
    }

    public function getServicesRequiringConsultation(int $tenantId): Collection
    {
        return OfferedService::where('tenant_id', $tenantId)
            ->where('is_active', true)
            ->where('requires_consultation', true)
            ->with('category')
            ->get();
    }

    public function getServicesRequiringPatchTest(int $tenantId): Collection
    {
        return OfferedService::where('tenant_id', $tenantId)
            ->where('is_active', true)
            ->where('requires_patch_test', true)
            ->with('category')
            ->get();
    }
}