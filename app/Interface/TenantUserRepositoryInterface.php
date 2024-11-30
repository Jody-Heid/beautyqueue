<?php

namespace App\Interface;

use App\Models\User;
use App\Models\Tenant;
use Illuminate\Database\Eloquent\Collection;

interface TenantUserRepositoryInterface
{
    /**
     * Gets all users for a specific tenant
     *
     * @param Tenant $tenant
     * @return Collection
     */
    public function getAllTenantUsers(Tenant $tenant): Collection;

    /**
     * Retrieve a User model instance by id within a tenant
     *
     * @param int|string $id
     * @param Tenant $tenant
     * @return User
     */
    public function getTenantUserById(int|string $id, Tenant $tenant): User;

    /**
     * Retrieve a User model instance by email within a tenant
     *
     * @param string $email
     * @param Tenant $tenant
     * @return User|null
     */
    public function getTenantUserByEmail(string $email, Tenant $tenant): ?User;

    /**
     * Retrieve a User model instance by cellphone number within a tenant
     *
     * @param string $cellphoneNumber
     * @param Tenant $tenant
     * @return User
     */
    public function getTenantUserByCellphoneNumber(string $cellphoneNumber, Tenant $tenant): User;

    /**
     * Create a new User for a tenant
     *
     * @param array $userDetails
     * @param Tenant $tenant
     * @return User
     */
    public function createTenantUser(array $userDetails, Tenant $tenant): User;

    /**
     * Update an existing User within a tenant
     *
     * @param array $newDetails
     * @param User $user
     * @param Tenant $tenant
     * @return User
     */
    public function updateTenantUser(array $newDetails, User $user, Tenant $tenant): User;

    /**
     * Remove an existing User from a tenant
     *
     * @param User $user
     * @param Tenant $tenant
     */
    public function deleteTenantUser(User $user, Tenant $tenant): void;

    /**
     * Verify if a user belongs to a tenant
     *
     * @param User $user
     * @param Tenant $tenant
     * @return bool
     */
    public function verifyUserBelongsToTenant(User $user, Tenant $tenant): bool;
}