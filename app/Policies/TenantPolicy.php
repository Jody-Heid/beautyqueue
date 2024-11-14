<?php

namespace App\Policies;

use App\Models\Tenant;
use App\Models\User;
use Illuminate\Auth\Access\HandlesAuthorization;
use Illuminate\Auth\Access\Response;

class TenantPolicy
{
    use HandlesAuthorization;

    /**
     * Determine whether the user can view any tenants.
     */
    public function viewAny(User $user): Response
    {
        return $user->can('view_any_tenants')
        ? Response::allow()
        : Response::denyAsNotFound();
    }

    /**
     * Determine whether the user can view the tenant.
     */
    public function view(User $user, Tenant $tenant): Response
    {
        return $user->can('view_tenants')
        ? Response::allow()
        : Response::denyAsNotFound();
    }

    /**
     * Determine whether the user can create tenants.
     */
    public function create(User $user): Response
    {
        return $user->can('create_tenants')
        ? Response::allow()
        : Response::denyAsNotFound();
    }

    /**
     * Determine whether the user can update the tenant.
     */
    public function update(User $user, Tenant $tenant): Response
    {
        return $user->can('update_tenants')
        ? Response::allow()
        : Response::denyAsNotFound();
    }

    /**
     * Determine whether the user can delete the tenant.
     */
    public function delete(User $user, Tenant $tenant): Response
    {
        return $user->can('delete_tenants')
        ? Response::allow()
        : Response::denyAsNotFound();
    }

    /**
     * Determine whether the user can restore the tenant.
     */
    public function restore(User $user, Tenant $tenant): Response
    {
        return Response::denyAsNotFound();
    }

    /**
     * Determine whether the user can permanently delete the tenant.
     */
    public function forceDelete(User $user, Tenant $tenant): Response
    {
        return Response::denyAsNotFound();
    }
}
