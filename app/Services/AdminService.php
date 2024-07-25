<?php

namespace App\Services;

use App\Interface\AdminRepositoryInterface;
use App\Interface\RoleRepositoryInterface;
use App\Models\Admin;
use App\Traits\ConvertsCommaSeparatedString;
use Illuminate\Database\Eloquent\Collection;

class AdminService
{
    use ConvertsCommaSeparatedString;

    public function __construct(
        private readonly AdminRepositoryInterface $adminRepositoryInterface,
        private readonly RoleRepositoryInterface $roleRepository,
    ) {
    }

    /**
     * List all admins.
     */
    public function listAdmins(): Collection
    {
        return $this->adminRepositoryInterface->getAllAdmins();
    }

    /**
     * Create a new Admin and assign a role.
     */
    public function createAdmin(array $adminData): Admin
    {
        $admin = $this->adminRepositoryInterface->createAdmin($adminData);

        return $admin;
    }

    /**
     * Get a specific Admin by ID.
     */
    public function getAdminById(string|int $id): Admin
    {
        return $this->adminRepositoryInterface->getAdminById($id);
    }

    /**
     * Update an existing Admin and sync their roles.
     */
    public function updateAdmin(array $adminData, Admin $admin): Admin
    {
        $this->adminRepositoryInterface->updateAdmin($adminData, $admin);

        return $admin;
    }

    /**
     * Delete a specific Admin.
     */
    public function destroyAdmin(Admin $admin): void
    {
        $this->adminRepositoryInterface->deleteAdmin($admin);

    }
}
