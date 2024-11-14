<?php

namespace App\Services;

use App\Interface\RoleRepositoryInterface;
use App\Interface\StaffRepositoryInterface;
use App\Models\Staff;
use App\Traits\ConvertsCommaSeparatedString;
use Illuminate\Database\Eloquent\Collection;

class StaffService
{
    use ConvertsCommaSeparatedString;

    public function __construct(
        private readonly StaffRepositoryInterface $staffRepository,
        private readonly RoleRepositoryInterface $roleRepository,
    ) {
    }

    /**
     * List all staff.
     */
    public function listStaff(): Collection
    {
        return $this->staffRepository->getAllStaff();
    }

    /**
     * Create a new staff and assign a role.
     */
    public function createStaff(array $staffData): Staff
    {
        $staff = $this->staffRepository->createStaff($staffData);

        return $staff;
    }

    /**
     * Get a specific staff by ID.
     */
    public function getStaffById(string|int $id): Staff
    {
        return $this->staffRepository->getStaffById($id);
    }

    /**
     * Update an existing staff and sync their roles.
     */
    public function updateStaff(array $staffData, Staff $staff): Staff
    {
        $this->staffRepository->updateStaff($staffData, $staff);

        return $staff;
    }

    /**
     * Delete a specific staff.
     */
    public function destroyStaff(Staff $staff): void
    {
        $this->staffRepository->deleteStaff($staff);

    }
}
