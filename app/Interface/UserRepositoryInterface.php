<?php

namespace App\Interface;

use App\Models\User;
use Illuminate\Database\Eloquent\Collection;

interface UserRepositoryInterface
{
    /**
     * Gets all users
     */
    public function getAllUsers(): Collection;

    /**
     * Retrieve a User model instance by id
     */
    public function getUserById(int|string $id): User;

    /**
     * Create a new User
     */
    public function createUser(array $userDetails): User;

    /**
     * Update an existing User
     */
    public function updateUser(array $newDetails, User $user): User;

    /**
     * Remove an existing User
     */
    public function deleteUser(User $user): void;
}
