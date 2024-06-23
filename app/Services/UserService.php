<?php

namespace App\Services;

use App\Interface\RoleRepositoryInterface;
use App\Interface\UserRepositoryInterface;
use App\Models\User;
use App\Transformers\UserTransformer;
use Flugg\Responder\Responder;
use Illuminate\Http\JsonResponse;

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
    public function listUsers(): JsonResponse
    {
        $users = $this->userRepository->getAllUsers();

        return $users->isEmpty()
            ? $this->responder->success($users)->meta(['message' => 'No Users Found'])->respond()
            : $this->responder->success($users, UserTransformer::class)->respond();
    }

    /**
     * Create a new user and assign a role.
     *
     */
    public function createUser(array $userData): JsonResponse
    {
        $user = $this->userRepository->createUser($userData);
        $role = $this->roleRepository->getById($userData['role_id']);
        $user->assignRole($role->name);

        return $this->responder->success($user, UserTransformer::class)->meta(['message' => 'User Created'])->respond();
    }

    /**
     * Get a specific user by ID.
     */
    public function getUser(User $user): JsonResponse
    {
        return $this->responder->success($user, UserTransformer::class)->respond();
    }

    /**
     * Update an existing user and sync their roles.
     */
    public function updateUser(array $userData, User $user): JsonResponse
    {
        $this->userRepository->updateUser($userData, $user);
        $role = $this->roleRepository->getById($userData['role_id']);
        $user->syncRoles($role->name);

        return $this->responder->success($user, UserTransformer::class)->meta(['message' => 'User Updated'])->respond();
    }

    /**
     * Delete a specific user.
     */
    public function destroyUser(User $user): JsonResponse
    {
        $this->userRepository->deleteUser($user);

        return $this->responder->success()->meta(['message' => 'User Deleted'])->respond();
    }
}
