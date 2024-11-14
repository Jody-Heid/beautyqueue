<?php

namespace App\Http\Controllers\API\V1;

use App\Http\Controllers\Controller;
use App\Http\Requests\UserCreateRequest;
use App\Http\Requests\UserUpdateRequest;
use App\Models\User;
use App\Services\UserService;
use App\Transformers\UserTransformer;
use Flugg\Responder\Responder;
use Illuminate\Http\JsonResponse;

class UserController extends Controller
{
    public function __construct(
        private readonly UserService $userService,
        private readonly Responder $responder
    ) {
        $this->authorizeResource(User::class, 'user');
    }

    public function index(): JsonResponse
    {
        $users = $this->userService->listUsers();

        return $users->isEmpty()
            ? $this->responder->success($users)->meta(['message' => 'No Users Found'])->respond()
            : $this->responder->success($users, UserTransformer::class)->respond();
    }

    public function store(UserCreateRequest $request): JsonResponse
    {
        $user = $this->userService->createUser($validatedData = $request->validated());

        $user->assignRole($validatedData['role']);

        if (! blank($validatedData['permissions'])) {
            $user->syncPermissions($validatedData['permissions']);
        }

        return $this->responder->success($user, UserTransformer::class)->meta(['message' => 'User Created'])->respond();
    }

    public function show(User $user): JsonResponse
    {
        return $this->responder->success($user, UserTransformer::class)->respond();
    }

    public function update(UserUpdateRequest $request, User $user): JsonResponse
    {
        $user = $this->userService->updateUser($validatedData = $request->validated(), $user);

        $user->assignRole($validatedData['role']);

        if (! blank($validatedData['permissions'])) {
            $user->syncPermissions($validatedData['permissions']);
        }

        return $this->responder->success($user, UserTransformer::class)->meta(['message' => 'User Updated'])->respond();
    }

    public function destroy(User $user): JsonResponse
    {
        $this->userService->destroyUser($user);

        return $this->responder->success()->meta(['message' => 'User Deleted'])->respond();
    }
}
