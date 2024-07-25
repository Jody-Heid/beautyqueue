<?php

namespace App\Interface;

use App\Models\Admin;
use Illuminate\Database\Eloquent\Collection;

interface AdminRepositoryInterface
{
    /**
     * Gets all admins.
     */
    public function getAllAdmins(): Collection;

    /**
     * Retrieve an Admin model instance by id.
     */
    public function getAdminById(int|string $id): Admin;

    /**
     * Retrieve an Admin model instance by email.
     */
    public function getAdminByEmail(string $email): Admin;

    /**
     * Retrieve an Admin model instance by cellphone number.
     */
    public function getAdminByCellphoneNumber(string $cellphoneNumber): Admin;

    /**
     * Create a new Admin.
     */
    public function createAdmin(array $adminDetails): Admin;

    /**
     * Update an existing Admin.
     */
    public function updateAdmin(array $newDetails, Admin $admin): Admin;

    /**
     * Remove an existing Admin.
     */
    public function deleteAdmin(Admin $admin): void;
}
