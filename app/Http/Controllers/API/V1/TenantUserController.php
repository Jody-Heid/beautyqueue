<?php

namespace App\Http\Controllers\API\V1;

use App\Http\Controllers\Controller;
use App\Http\Requests\UserCreateRequest;
use App\Http\Requests\UserUpdateRequest;
use App\Models\User;
use App\Models\Tenant;
use App\Services\TenantUserService;
use App\Transformers\UserTransformer;
use Flugg\Responder\Responder;
use Illuminate\Http\JsonResponse;

class TenantUserController extends Controller
{
    public function __construct(
        private readonly TenantUserService $tenantUserService,
        private readonly Responder $responder
    ) {
        $this->authorizeResource(User::class, 'user');
    }

    public function index(Tenant $tenant): JsonResponse
    {
        $users = $this->tenantUserService->listTenantUsers($tenant);

        return $users->isEmpty()
            ? $this->responder->success($users)->meta(['message' => 'No Users Found for this Tenant'])->respond()
            : $this->responder->success($users, UserTransformer::class)->respond();
    }

    public function store(UserCreateRequest $request, Tenant $tenant): JsonResponse
    {
        $validatedData = $request->validated();
        
        $user = $this->tenantUserService->createTenantUser($validatedData, $tenant);

        $user->assignRole($validatedData['role']);

        if (! blank($validatedData['permissions'])) {
            $user->syncPermissions($validatedData['permissions']);
        }

        return $this->responder->success($user, UserTransformer::class)
            ->meta(['message' => 'Tenant User Created'])
            ->respond();
    }

    public function show(Tenant $tenant, User $user): JsonResponse
    {
        $user = $this->tenantUserService->getTenantUserById($user->id, $tenant);
        
        return $this->responder->success($user, UserTransformer::class)->respond();
    }

    public function update(UserUpdateRequest $request, Tenant $tenant, User $user): JsonResponse
    {
        $validatedData = $request->validated();
        
        $user = $this->tenantUserService->updateTenantUser($validatedData, $user, $tenant);

        $user->assignRole($validatedData['role']);

        if (! blank($validatedData['permissions'])) {
            $user->syncPermissions($validatedData['permissions']);
        }

        return $this->responder->success($user, UserTransformer::class)
            ->meta(['message' => 'Tenant User Updated'])
            ->respond();
    }

    public function destroy(Tenant $tenant, User $user): JsonResponse
    {
        $this->tenantUserService->destroyTenantUser($user, $tenant);

        return $this->responder->success()
            ->meta(['message' => 'Tenant User Deleted'])
            ->respond();
    }

    /**
     * Transfer a user to another tenant
     */
    public function transfer(Tenant $fromTenant, User $user, Tenant $toTenant): JsonResponse
    {
        $user = $this->tenantUserService->transferUserToTenant($user, $fromTenant, $toTenant);

        return $this->responder->success($user, UserTransformer::class)
            ->meta(['message' => 'User Transferred Successfully'])
            ->respond();
    }

    /**
     * Get user by email within tenant
     */
    public function findByEmail(Tenant $tenant, string $email): JsonResponse
    {
        $user = $this->tenantUserService->getTenantUserByEmail($email, $tenant);

        return $user 
            ? $this->responder->success($user, UserTransformer::class)->respond()
            : $this->responder->error('User not found')->respond(404);
    }
}