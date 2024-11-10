<?php

namespace App\Policies;

use App\Models\OfferedService;
use App\Models\User;
use Illuminate\Auth\Access\HandlesAuthorization;
use Illuminate\Auth\Access\Response;

class ServicePolicy
{
    use HandlesAuthorization;

    /**
     * Determine whether the user can view any services.
     */
    public function viewAny(User $user): Response
    {
        return $user->can('view_services')
        ? Response::allow()
        : Response::denyAsNotFound();
    }

    /**
     * Determine whether the user can view the service.
     */
    public function view(User $user, OfferedService $service): Response
    {
        return $user->can('view_services')
        ? Response::allow()
        : Response::denyAsNotFound();
    }

    /**
     * Determine whether the user can create services.
     */
    public function create(User $user): Response
    {
        return $user->can('create_services')
        ? Response::allow()
        : Response::denyAsNotFound();
    }

    /**
     * Determine whether the user can update the service.
     */
    public function update(User $user, OfferedService $service): Response
    {
        return $user->can('update_services')
        ? Response::allow()
        : Response::denyAsNotFound();
    }

    /**
     * Determine whether the user can delete the service.
     */
    public function delete(User $user, OfferedService $service): Response
    {
        return $user->can('delete_services')
        ? Response::allow()
        : Response::denyAsNotFound();
    }

    /**
     * Determine whether the user can restore the service.
     */
    public function restore(User $user, OfferedService $service): Response
    {
        return Response::denyAsNotFound();
    }

    /**
     * Determine whether the user can permanently delete the service.
     */
    public function forceDelete(User $user, OfferedService $service): Response
    {
        return Response::denyAsNotFound();
    }
}
