<?php

namespace App\Policies;

use App\Models\Hairstylist;
use App\Models\User;
use Illuminate\Auth\Access\Response;

class HairstylistPolicy
{
    /**
     * Determine whether the user can view any models.
     */
    public function viewAny(User $user): Response
    {
        return $user->can('view_any_hairstylist') ?
         Response::allow()
        : Response::denyAsNotFound();
    }

    /**
     * Determine whether the user can view the model.
     */
    public function view(User $user, Hairstylist $hairstylist): Response
    {
        return $user->can('view_any_hairstylist') || $user->can('view_hairstylist') && $hairstylist->id === $user->id
        ? Response::allow()
        : Response::denyAsNotFound();
    }

    /**
     * Determine whether the user can create models.
     */
    public function create(User $user): Response
    {
        return $user->can('create_hairstylist')
        ? Response::allow()
        : Response::denyAsNotFound();
    }

    /**
     * Determine whether the user can update the model.
     */
    public function update(User $user, Hairstylist $hairstylist): Response
    {
        return $user->can('update_any_hairstylist') || $user->can('update_hairstylist') && $hairstylist->id === $user->id
        ? Response::allow()
        : Response::denyAsNotFound();
    }

    /**
     * Determine whether the user can delete the model.
     */
    public function delete(User $user, Hairstylist $hairstylist): Response
    {
        return $user->can('delete_hairstylist')
        ? Response::allow()
        : Response::denyAsNotFound();
    }

    /**
     * Determine whether the user can restore the model.
     */
    public function restore(User $user, Hairstylist $hairstylist): Response
    {
        return Response::denyAsNotFound();
    }

    /**
     * Determine whether the user can permanently delete the model.
     */
    public function forceDelete(User $user, Hairstylist $hairstylist): Response
    {
        return Response::denyAsNotFound();
    }
}
