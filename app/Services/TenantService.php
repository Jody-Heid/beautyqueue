<?php

namespace App\Services;

use App\Interface\RoleRepositoryInterface;
use App\Interface\TenantUserRepositoryInterface;
use App\Models\Tenant;
use App\Traits\ConvertsCommaSeparatedString;
use Illuminate\Database\Eloquent\Collection;

class TenantService
{
    use ConvertsCommaSeparatedString;

    public function __construct(
        private readonly TenantUserRepositoryInterface $tenantRepository,
        private readonly RoleRepositoryInterface $roleRepository,
    ) {
    }

    /**
     * List all tenants.
     */
    public function listTenants(): Collection
    {
        return $this->tenantRepository->getAllTenants();
    }

    /**
     * Create a new tenant and assign a role.
     */
    public function createTenant(array $tenantData): Tenant
    {
        $tenant = $this->tenantRepository->createTenant($tenantData);

        return $tenant;
    }

    /**
     * Get a specific tenant by ID.
     */
    public function getTenantById(string|int $id): Tenant
    {
        return $this->tenantRepository->getTenantById($id);
    }

    /**
     * Update an existing tenant and sync their roles.
     */
    public function updateTenant(array $tenantData, Tenant $tenant): Tenant
    {
        $this->tenantRepository->updateTenant($tenantData, $tenant);

        return $tenant;
    }

    /**
     * Delete a specific tenant.
     */
    public function destroyTenant(Tenant $tenant): void
    {
        $this->tenantRepository->deleteTenant($tenant);

    }
}
