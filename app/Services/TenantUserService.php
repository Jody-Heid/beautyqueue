<?php

namespace App\Services;

use App\Interface\RoleRepositoryInterface;
use App\Interface\TenantUserRepositoryInterface;
use App\Models\User;
use App\Models\Tenant;
use App\Traits\ConvertsCommaSeparatedString;
use Illuminate\Database\Eloquent\Collection;

class TenantUserService
{
    use ConvertsCommaSeparatedString;

    public function __construct(
        private readonly TenantUserRepositoryInterface $tenantUserRepository,
        private readonly RoleRepositoryInterface $roleRepository,
    ) {
    }

    /**
     * List all users for a specific tenant.
     */
    public function listTenantUsers(Tenant $tenant): Collection
    {
        return $this->tenantUserRepository->getAllTenantUsers($tenant);
    }

    /**
     * Create a new user for a tenant and assign a role.
     */
    public function createTenantUser(array $userData, Tenant $tenant): User
    {
        $user = $this->tenantUserRepository->createTenantUser($userData, $tenant);

        return $user;
    }

    /**
     * Get a specific tenant user by ID.
     */
    public function getTenantUserById(string|int $id, Tenant $tenant): User
    {
        return $this->tenantUserRepository->getTenantUserById($id, $tenant);
    }

    /**
     * Get a tenant user by email.
     */
    public function getTenantUserByEmail(string $email, Tenant $tenant): ?User
    {
        return $this->tenantUserRepository->getTenantUserByEmail($email, $tenant);
    }

    /**
     * Get a tenant user by cellphone number.
     */
    public function getTenantUserByCellphoneNumber(string $cellphoneNumber, Tenant $tenant): User
    {
        return $this->tenantUserRepository->getTenantUserByCellphoneNumber($cellphoneNumber, $tenant);
    }

    /**
     * Update an existing tenant user and sync their roles.
     */
    public function updateTenantUser(array $userData, User $user, Tenant $tenant): User
    {
        $this->tenantUserRepository->updateTenantUser($userData, $user, $tenant);

        return $user;
    }

    /**
     * Delete a specific tenant user.
     */
    public function destroyTenantUser(User $user, Tenant $tenant): void
    {
        $this->tenantUserRepository->deleteTenantUser($user, $tenant);
    }

    /**
     * Transfer a user from one tenant to another.
     */
    public function transferUserToTenant(User $user, Tenant $fromTenant, Tenant $toTenant): User
    {
        $this->tenantUserRepository->deleteTenantUser($user, $fromTenant);
        $this->tenantUserRepository->createTenantUser($user->toArray(), $toTenant);

        return $user;
    }

    /**
     * Get all tenants a user belongs to.
     */
    public function getUserTenants(User $user): Collection
    {
        return $user->tenants;
    }
}