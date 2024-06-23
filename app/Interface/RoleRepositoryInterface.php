<?php

namespace App\Interface;

use Spatie\Permission\Models\Permission;
use Spatie\Permission\Models\Role;

interface RoleRepositoryInterface
{
    /**
     * Retrieve a role by its ID.
     *
     * @param  string|int  $id  The ID of the role.
     * @return Role The role instance.
     */
    public function getRoleById(string|int $id, ?string $guardName = null): Role;

    /**
     * Retrieve a role by its name.
     *
     * @param  string  $name  The name of the role.
     * @return Role The role instance.
     */
    public function getByName(string $name, ?string $guardName = null): Role;

    /**
     * Create a new role.
     *
     * @param  string  $name  The name of the role.
     * @param  string|null  $guardName  The guard name for the role (optional).
     * @return Role The created role instance.
     */
    public function createRole(string $name, ?string $guardName): Role;

    /**
     * Update an existing role.
     *
     * @param  string  $name  The new name of the role.
     * @param  string|null  $guardName  The guard name for the role (optional).
     * @param  Role  $role  The role instance to update.
     * @return Role The updated role instance.
     */
    public function updateRole(string $name, ?string $guardName, Role $role): Role;

    /**
     * Delete a role.
     */
    public function deleteRole(Role $role): void;

    /**
     * Get the permissions associated with the role.
     *
     * @return Permission The permission instance.
     */
    public function getRolePermissions(Role $role): Permission;
}
