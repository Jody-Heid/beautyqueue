<?php

namespace App\Repositories;

use App\Interface\StaffRepositoryInterface;
use App\Models\Staff;
use Illuminate\Database\Eloquent\Collection;

class StaffRepository implements StaffRepositoryInterface
{
    /**
     * Gets all staff
     */
    public function getAllStaff(): Collection
    {
        return Staff::all();
    }

    /**
     * Retrieve a Staff model instance by id
     */
    public function getStaffById(int|string $id): Staff
    {
        return Staff::findOrFail($id);
    }

    /**
     * Create a new Staff
     */
    public function createStaff(array $staffDetails): Staff
    {
        return Staff::create($staffDetails);
    }

    /**
     * Update an existing Staff
     */
    public function updateStaff(array $newDetails, Staff $staff): Staff
    {
        $staff->update($newDetails);
        $staff->refresh();

        return $staff;
    }

    /**
     * Remove an existing Staff
     */
    public function deleteStaff(Staff $staff): void
    {
        $staff->delete();
    }

    /**
     * Retrieve a Staff model instance by email
     */
    public function getStaffByEmail(string $email): ?Staff
    {
        return Staff::where('email', $email)->first();
    }
}
