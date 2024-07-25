<?php

namespace App\Policies;

use App\Models\Hairstylist;
use App\Models\User;

class HairStylistPolicy
{
    /**
     * Determine whether the user can view any models.
     */
    public function viewAny(User $user): bool
    {
        return $user->admin()->exists();
    }

    /**
     * Determine whether the user can view the model.
     */
    public function view(User $user, Hairstylist $hairstylist): bool
    {
        return $hairstylist->id === $user->id;
    }

    /**
     * Determine whether the user can create models.
     */
    public function create(User $user): bool
    {
        return $user->admin()->exists();
    }

    /**
     * Determine whether the user can update the model.
     */
    public function update(User $user, Hairstylist $hairstylist): bool
    {
        return $hairstylist->id === $user->id && $user->hairstylist()->exists();
    }

    /**
     * Determine whether the user can delete the model.
     */
    public function delete(User $user, Hairstylist $hairstylist): bool
    {
        return $user->admin()->exists();
    }

    /**
     * Determine whether the user can restore the model.
     */
    public function restore(User $user, Hairstylist $hairstylist): bool
    {
        return $user->admin()->exists();
    }

    /**
     * Determine whether the user can permanently delete the model.
     */
    public function forceDelete(User $user, Hairstylist $hairstylist): bool
    {
        return $user->admin()->exists();
    }
}
