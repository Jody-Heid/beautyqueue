<?php

namespace App\Services;

use App\Interface\RoleRepositoryInterface;
use App\Interface\UserRepositoryInterface;
use App\Models\User;
use Flugg\Responder\Responder;
use Illuminate\Database\Eloquent\Collection;

class UserService
{
    public function __construct(
        private readonly UserRepositoryInterface $userRepository,
        private readonly RoleRepositoryInterface $roleRepository,
        private readonly Responder $responder
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
        $role = $this->roleRepository->getRoleById($userData['role_id']);
        $user->assignRole($role->name);

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
        $role = $this->roleRepository->getRoleById($userData['role_id']);
        $user->syncRoles($role->name);

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
