<?php

namespace App\Services;

use App\Interface\RoleRepositoryInterface;
use App\Interface\UserRepositoryInterface;
use App\Models\User;
use App\Traits\ConvertsCommaSeparatedString;
use Illuminate\Database\Eloquent\Collection;

class UserService
{
    use ConvertsCommaSeparatedString;

    public function __construct(
        private readonly UserRepositoryInterface $userRepository,
        private readonly RoleRepositoryInterface $roleRepository,
    ) {
    }

    /**
     * List all users.
     */
    public function listUsers(): Collection
    {
        return $this->userRepository->getAllUsers();
    }

    /**
     * Create a new user and assign a role.
     */
    public function createUser(array $userData): User
    {
        $user = $this->userRepository->createUser($userData);

        return $user;
    }

    /**
     * Get a specific user by ID.
     */
    public function getUserById(string|int $id): User
    {
        return $this->userRepository->getUserById($id);
    }

    /**
     * Update an existing user and sync their roles.
     */
    public function updateUser(array $userData, User $user): User
    {
        $this->userRepository->updateUser($userData, $user);

        return $user;
    }

    /**
     * Delete a specific user.
     */
    public function destroyUser(User $user): void
    {
        $this->userRepository->deleteUser($user);

    }
}
