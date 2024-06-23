<?php

namespace App\Repositories;

use App\Interface\RoleRepositoryInterface;
use Spatie\Permission\Models\Permission;
use Spatie\Permission\Models\Role;
use Throwable;

class RoleRepository implements RoleRepositoryInterface
{
    /**
     * Retrieve a role by its ID.
     *
     * @param  string|int  $id  The ID of the role.
     * @return Role The role instance.
     */
    public function getRoleById(int|string $id, ?string $guardName = 'api'): Role
    {
        return Role::findById($id, $guardName);
    }

    /**
     * Retrieve a role by its name.
     *
     * @param  string  $name  The name of the role.
     * @return Role The role instance.
     */
    public function getByName(string $name, ?string $guardName = 'api'): Role
    {
        return Role::findByName($name, $guardName);
    }

    /**
     * Create a new role.
     *
     * @param  string  $name  The name of the role.
     * @param  string|null  $guardName  The guard name for the role (optional).
     * @return Role The created role instance.
     */
    public function createRole(string $name, ?string $guardName = 'api'): Role
    {
        return Role::create([
            'name' => $name,
            'guard_name' => $guardName,
        ]);
    }

    /**
     * Update an existing role.
     *
     * @param  string  $name  The new name of the role.
     * @param  string|null  $guardName  The guard name for the role (optional).
     * @param  Role  $role  The role instance to update.
     * @return Role The updated role instance.
     */
    public function updateRole(string $name, ?string $guardName, Role $role): Role
    {
        $role->update([
            'name' => $name,
            'guard_name' => $guardName,
        ]);
        $role->refresh();

        return $role;
    }

    /**
     * Delete a role.
     *
     * @throws Throwable
     */
    public function deleteRole(Role $role): void
    {
        $role->deleteOrFail();
    }

    /**
     * Get the permissions associated with the role.
     *
     * @return Permission The permission instance.
     */
    public function getRolePermissions(Role $role): Permission
    {
        if (! empty($role->permissions)) {
            return $role->permissions;
        }
    }
}
