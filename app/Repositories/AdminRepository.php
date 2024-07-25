<?php

namespace App\Repositories;

use App\Interface\AdminRepositoryInterface;
use App\Models\Admin;
use Illuminate\Database\Eloquent\Collection;

class AdminRepository implements AdminRepositoryInterface
{
    /**
     * Gets all admins
     */
    public function getAllAdmins(): Collection
    {
        return Admin::all();
    }

    /**
     * Retrieve an Admin model instance by id
     */
    public function getAdminById(int|string $id): Admin
    {
        return Admin::findOrFail($id);
    }

    /**
     * Retrieve an Admin model instance by email
     */
    public function getAdminByEmail(string $email): Admin
    {
        return Admin::where('email', $email)->firstOrFail();
    }

    /**
     * Retrieve an Admin model instance by cellphone number
     */
    public function getAdminByCellphoneNumber(string $cellphoneNumber): Admin
    {
        return Admin::where('cellphone_number', $cellphoneNumber)->firstOrFail();
    }

    /**
     * Create a new Admin
     */
    public function createAdmin(array $adminDetails): Admin
    {
        $admin = Admin::create($adminDetails);

        return $admin;
    }

    /**
     * Update an existing Admin
     */
    public function updateAdmin(array $newDetails, Admin $admin): Admin
    {
        $admin->update($newDetails);

        return $admin;
    }

    /**
     * Remove an existing Admin
     */
    public function deleteAdmin(Admin $admin): void
    {
        $admin->delete();
    }
}
