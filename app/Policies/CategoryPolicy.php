<?php

namespace App\Policies;

use App\Models\Category;
use App\Models\User;
use Illuminate\Auth\Access\HandlesAuthorization;
use Illuminate\Auth\Access\Response;

class CategoryPolicy
{
    use HandlesAuthorization;

    /**
     * Determine whether the user can view any categories.
     */
    public function viewAny(User $user): Response
    {
        return $user->can('view_any_categories')
            ? Response::allow()
            : Response::denyAsNotFound();
    }

    /**
     * Determine whether the user can view the category.
     */
    public function view(User $user, Category $category): Response
    {
        if (!$user->can('view_categories')) {
            return Response::denyAsNotFound();
        }

        return $user->tenant_id === $category->tenant_id
            ? Response::allow()
            : Response::denyAsNotFound();
    }

    /**
     * Determine whether the user can create categories.
     */
    public function create(User $user): Response
    {
        return $user->can('create_categories')
            ? Response::allow()
            : Response::denyAsNotFound();
    }

    /**
     * Determine whether the user can update the category.
     */
    public function update(User $user, Category $category): Response
    {
        if ($user->can('update_any_categories')) {
            return Response::allow();
        }

        if (!$user->can('update_categories')) {
            return Response::denyAsNotFound();
        }

        return $user->tenant_id === $category->tenant_id
            ? Response::allow()
            : Response::denyAsNotFound();
    }

    /**
     * Determine whether the user can delete the category.
     */
    public function delete(User $user, Category $category): Response
    {
        if ($user->can('delete_any_categories')) {
            if ($category->services()->exists()) {
                return Response::deny('Cannot delete category with existing services.');
            }
            return Response::allow();
        }

        if (!$user->can('delete_categories')) {
            return Response::denyAsNotFound();
        }

        if ($category->services()->exists()) {
            return Response::deny('Cannot delete category with existing services.');
        }

        return $user->tenant_id === $category->tenant_id
            ? Response::allow()
            : Response::denyAsNotFound();
    }
}