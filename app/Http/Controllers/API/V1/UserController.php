<?php

namespace App\Http\Controllers\API\V1;

use App\Http\Controllers\Controller;
use App\Http\Requests\UserCreateRequest;
use App\Http\Requests\UserUpdateRequest;
use App\Models\User;
use App\Repositories\RoleRepository;
use App\Repositories\UserRepository;
use App\Transformers\UserTransformer;
use Flugg\Responder\Http\Responses\SuccessResponseBuilder;
use Flugg\Responder\Responder;

class UserController extends Controller
{
    public function __construct(private readonly UserRepository $userRepository,
        private readonly RoleRepository $roleRepository,
        private readonly Responder $responder)
    {
        $this->authorizeResource(User::class, 'user');
    }

    /**
     * Display a listing of the resource.
     */
    public function index(): SuccessResponseBuilder
    {
        $users = $this->userRepository->getAllUsers();

        return $users->isEmpty()
            ? $this->responder->success($users)->meta(['message' => 'No Users Found'])
            : $this->responder->success($users, UserTransformer::class);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(UserCreateRequest $request): SuccessResponseBuilder
    {
        $user = $this->userRepository->createUser($request->validated());
        $role = $this->roleRepository->getById($request->validated('role_id'));
        $user->assignRole($role->name);

        return $this->responder->success($user, UserTransformer::class)->meta(['message' => 'User Created']);
    }

    /**
     * Display the specified resource.
     */
    public function show(User $user): SuccessResponseBuilder
    {
        return $this->responder->success($user, UserTransformer::class);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UserUpdateRequest $request, User $user): SuccessResponseBuilder
    {
        $this->userRepository->updateUser($request->validated(), $user);
        $role = $this->roleRepository->getById($request->validated('role_id'));
        $user->syncRoles($role->name);

        return $this->responder->success($user, UserTransformer::class)->meta(['message' => 'User Updated']);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(User $user): SuccessResponseBuilder
    {
        $this->userRepository->deleteUser($user);

        return $this->responder->success()->meta(['message' => 'User Deleted']);
    }
}
