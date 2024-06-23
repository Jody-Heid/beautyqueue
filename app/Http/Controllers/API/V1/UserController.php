<?php

namespace App\Http\Controllers\API\V1;

use App\Http\Controllers\Controller;
use App\Http\Requests\UserCreateRequest;
use App\Http\Requests\UserUpdateRequest;
use App\Models\User;
use App\Services\UserService;
use Flugg\Responder\Responder;
use Illuminate\Http\JsonResponse;
use Illuminate\Support\Facades\DB;
use Throwable;

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
        return $this->userService->listUsers();
    }

    public function store(UserCreateRequest $request): JsonResponse
    {
        DB::beginTransaction();
        try {
            $response = $this->userService->createUser($request->validated());
            DB::commit();

            return $response;
        } catch (Throwable $e) {
            DB::rollBack();

            return $this->responder->error('userCreateFailed')->respond(500);
        }
    }

    public function show(User $user): JsonResponse
    {
        return $this->userService->getUser($user);
    }

    public function update(UserUpdateRequest $request, User $user): JsonResponse
    {
        DB::beginTransaction();
        try {
            $response = $this->userService->updateUser($request->validated(), $user);
            DB::commit();

            return $response;
        } catch (Throwable $e) {
            DB::rollBack();

            return $this->responder->error('userCreateFailed')->respond(500);
        }
    }

    public function destroy(User $user): JsonResponse
    {
        return $this->userService->destroyUser($user);
    }
}
