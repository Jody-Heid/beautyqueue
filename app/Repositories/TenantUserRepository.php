<?php

namespace App\Repositories;

use App\Interface\TenantUserRepositoryInterface;
use App\Models\User;
use App\Models\Tenant;
use Illuminate\Database\Eloquent\Collection;

class TenantUserRepository implements TenantUserRepositoryInterface
{
    /**
     * Gets all users for a specific tenant
     */
    public function getAllTenantUsers(Tenant $tenant): Collection
    {
        return $tenant->users()->get();
    }

    /**
     * Retrieve a User model instance by id within a tenant
     */
    public function getTenantUserById(int|string $id, Tenant $tenant): User
    {
        return $tenant->users()->find($id)->first();
    }

    /**
     * Create a new User for a tenant
     */
    public function createTenantUser(array $userDetails, Tenant $tenant): User
    {
        return User::create([
            ...$userDetails,
            'tenant_id' => $tenant->id
        ]);
    }

    /**
     * Update an existing User within a tenant
     */
    public function updateTenantUser(array $newDetails, User $user, Tenant $tenant): User
    {
        if ($user->tenant_id !== $tenant->id) {
            throw new \Exception('User does not belong to this tenant');
        }

        $user->update($newDetails);
        $user->refresh();
        
        return $user;
    }

    /**
     * Remove an existing User from a tenant
     */
    public function deleteTenantUser(User $user, Tenant $tenant): void
    {
        if ($user->tenant_id !== $tenant->id) {
            throw new \Exception('User does not belong to this tenant');
        }
        
        $user->delete();
    }

    /**
     * Retrieve a User model instance by email within a tenant
     */
    public function getTenantUserByEmail(string $email, Tenant $tenant): ?User
    {
        return $tenant->users()
            ->where('email', $email)
            ->first();
    }

    /**
     * Retrieve a User model instance by cellphone number within a tenant
     */
    public function getTenantUserByCellphoneNumber(string $cellphoneNumber, Tenant $tenant): User
    {
        return $tenant->users()
            ->where('cellphone_number', $cellphoneNumber)
            ->first();
    }

    /**
     * Verify if a user belongs to a tenant
     */
    public function verifyUserBelongsToTenant(User $user, Tenant $tenant): bool
    {
        return $user->tenant_id === $tenant->id;
    }
}