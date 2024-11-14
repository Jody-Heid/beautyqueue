<?php

namespace App\Repositories;

use App\Interface\TenantRepositoryInterface;
use App\Models\Tenant;
use Illuminate\Database\Eloquent\Collection;

class TenantRepository implements TenantRepositoryInterface
{
    /**
     * Gets all tenants
     */
    public function getAllTenants(): Collection
    {
        return Tenant::all();
    }

    /**
     * Retrieve a Tenant model instance by id
     */
    public function getTenantById(int|string $id): Tenant
    {
        return Tenant::findOrFail($id);
    }

    /**
     * Create a new Tenant
     */
    public function createTenant(array $tenantDetails): Tenant
    {
        return Tenant::create($tenantDetails);
    }

    /**
     * Update an existing Tenant
     */
    public function updateTenant(array $newDetails, Tenant $tenant): Tenant
    {
        $tenant->update($newDetails);
        $tenant->refresh();

        return $tenant;
    }

    /**
     * Remove an existing Tenant
     */
    public function deleteTenant(Tenant $tenant): void
    {
        $tenant->delete();
    }

    /**
     * Retrieve a Tenant model instance by email
     */
    public function getTenantByEmail(string $email): ?Tenant
    {
        return Tenant::where('email', $email)->first();
    }
}
