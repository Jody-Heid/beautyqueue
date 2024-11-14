<?php

namespace App\Policies;

use App\Models\Staff;
use App\Models\User;
use Illuminate\Auth\Access\HandlesAuthorization;
use Illuminate\Auth\Access\Response;

class StaffPolicy
{
    use HandlesAuthorization;

    /**
     * Determine whether the user can view any staff.
     */
    public function viewAny(User $user): Response
    {
        return $user->can('view_any_staff')
        ? Response::allow()
        : Response::denyAsNotFound();
    }

    /**
     * Determine whether the user can view the staff.
     */
    public function view(User $user, Staff $staff): Response
    {
        return $user->can('view_staff')
        ? Response::allow()
        : Response::denyAsNotFound();
    }

    /**
     * Determine whether the user can create staff.
     */
    public function create(User $user): Response
    {
        return $user->can('create_staff')
        ? Response::allow()
        : Response::denyAsNotFound();
    }

    /**
     * Determine whether the user can update the staff.
     */
    public function update(User $user, Staff $staff): Response
    {
        return $user->can(['update_staff', 'update_any_staff'])
        ? Response::allow()
        : Response::denyAsNotFound();
    }

    /**
     * Determine whether the user can delete the staff.
     */
    public function delete(User $user, Staff $staff): Response
    {
        return $user->can('delete_staff')
        ? Response::allow()
        : Response::denyAsNotFound();
    }

    /**
     * Determine whether the user can restore the staff.
     */
    public function restore(User $user, Staff $staff): Response
    {
        return Response::denyAsNotFound();
    }

    /**
     * Determine whether the user can permanently delete the staff.
     */
    public function forceDelete(User $user, Staff $staff): Response
    {
        return Response::denyAsNotFound();
    }
}
