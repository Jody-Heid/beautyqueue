<?php

namespace App\Policies;

use App\Models\Appointment;
use App\Models\User;
use Illuminate\Auth\Access\Response;

class AppointmentPolicy
{
    /**
     * Determine whether the user can view any models.
     */
    public function viewAny(User $user): Response
    {
        return $user->can('view_any_appointments')
            ? Response::allow()
            : Response::denyAsNotFound();
    }

    /**
     * Determine whether the user can view the model.
     */
    public function view(User $user, Appointment $appointment): Response
    {
        return $user->can('view_any_appointments') ||
            ($user->can('view_appointments') &&
                ($user->id === $appointment->customer_id || $user->id === $appointment->staff_id))
            ? Response::allow()
            : Response::denyAsNotFound();
    }

    /**
     * Determine whether the user can create models.
     */
    public function create(User $user): Response
    {
        return $user->can('create_appointments')
            ? Response::allow()
            : Response::denyAsNotFound();
    }

    /**
     * Determine whether the user can update the model.
     */
    public function update(User $user, Appointment $appointment): Response
    {
        return $user->can('update_any_appointments') ||
            ($user->can('update_appointments') &&
                ($user->id === $appointment->customer_id || $user->id === $appointment->staff_id))
            ? Response::allow()
            : Response::denyAsNotFound();
    }

    /**
     * Determine whether the user can delete the model.
     */
    public function delete(User $user, Appointment $appointment): Response
    {
        return $user->can('delete_any_appointments') || $user->can('delete_appointments')
            ? Response::allow()
            : Response::denyAsNotFound();
    }

    /**
     * Determine whether the user can restore the model.
     */
    public function restore(User $user, Appointment $appointment): Response
    {
        return Response::denyAsNotFound();
    }

    /**
     * Determine whether the user can permanently delete the model.
     */
    public function forceDelete(User $user, Appointment $appointment): Response
    {
        return Response::denyAsNotFound();
    }

    /**
     * Determine whether the user can change the appointment status.
     */
    public function changeAppointmentStatus(User $user, Appointment $appointment): Response
    {
        return $user->can('update_any_appointments') ||
            ($user->can('update_appointments') &&
                ($user->id === $appointment->customer_id || $user->id === $appointment->staff_id))
            ? Response::allow()
            : Response::denyAsNotFound();
    }
}
