<?php

namespace App\Interface;

use App\Models\Staff;
use Illuminate\Database\Eloquent\Collection;

interface StaffRepositoryInterface
{
    /**
     * Gets all staff
     */
    public function getAllStaff(): Collection;

    /**
     * Retrieve a Staff model instance by id
     */
    public function getStaffById(int|string $id): Staff;

    /**
     * Retrieve a Staff model instance by email
     */
    public function getStaffByEmail(string $email): ?Staff;

    /**
     * Create a new Staff
     */
    public function createStaff(array $staffDetails): Staff;

    /**
     * Update an existing Staff
     */
    public function updateStaff(array $newDetails, Staff $staff): Staff;

    /**
     * Remove an existing Staff
     */
    public function deleteStaff(Staff $staff): void;
}
