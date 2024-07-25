<?php

namespace App\Repositories;

use App\Interface\UserRepositoryInterface;
use App\Models\User;
use Illuminate\Database\Eloquent\Collection;

class UserRepository implements UserRepositoryInterface
{
    /**
     * Gets all users
     */
    public function getAllUsers(): Collection
    {
        return User::all();
    }

    /**
     * Retrieve a User model instance by id
     */
    public function getUserById(int|string $id): User
    {
        return User::findOrFail($id);
    }

    /**
     * Create a new User
     */
    public function createUser(array $userDetails): User
    {
        return User::create($userDetails);
    }

    /**
     * Update an existing User
     */
    public function updateUser(array $newDetails, User $user): User
    {
        $user->update($newDetails);
        $user->refresh();

        return $user;
    }

    /**
     * Remove an existing User
     */
    public function deleteUser(User $user): void
    {
        $user->delete();
    }

    /**
     * Retrieve a User model instance by email
     */
    public function getUserByEmail(string $email): ?User
    {
        return User::where('email', $email)->first();
    }

    /**
     * Retrieve a User model instance by cellphone number
     */
    public function getUserByCellphoneNumber(string $cellphoneNumber): User
    {
        return User::where('cellphone_number', $cellphoneNumber)->first();
    }
}
