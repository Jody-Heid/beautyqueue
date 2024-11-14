<?php

namespace App\Interface;

use App\Models\Tenant;
use Illuminate\Database\Eloquent\Collection;

interface TenantRepositoryInterface
{
    /**
     * Gets all tenants
     */
    public function getAllTenants(): Collection;

    /**
     * Retrieve a Tenant model instance by id
     */
    public function getTenantById(int|string $id): Tenant;

    /**
     * Retrieve a Tenant model instance by email
     */
    public function getTenantByEmail(string $email): ?Tenant;

    /**
     * Create a new Tenant
     */
    public function createTenant(array $tenantDetails): Tenant;

    /**
     * Update an existing Tenant
     */
    public function updateTenant(array $newDetails, Tenant $tenant): Tenant;

    /**
     * Remove an existing Tenant
     */
    public function deleteTenant(Tenant $tenant): void;
}
