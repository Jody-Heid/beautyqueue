<?php

namespace App\Http\Controllers\API\V1;

use App\Http\Controllers\Controller;
use App\Http\Requests\TenantCreateRequest;
use App\Http\Requests\TenantUpdateRequest;
use App\Models\Tenant;
use App\Services\TenantService;
use App\Transformers\TenantTransformer;
use Flugg\Responder\Responder;
use Illuminate\Http\JsonResponse;

class TenantController extends Controller
{
    public function __construct(
        private readonly TenantService $tenantService,
        private readonly Responder $responder
    ) {
        $this->authorizeResource(Tenant::class, 'tenant');
    }

    public function index(): JsonResponse
    {
        $tenants = $this->tenantService->listTenants();

        return $tenants->isEmpty()
            ? $this->responder->success($tenants)->meta(['message' => 'No Tenants Found'])->respond()
            : $this->responder->success($tenants, TenantTransformer::class)->respond();
    }

    public function store(TenantCreateRequest $request): JsonResponse
    {
        $tenant = $this->tenantService->createTenant($request->validated());

        return $this->responder->success($tenant, TenantTransformer::class)->meta(['message' => 'Tenant Created'])->respond();
    }

    public function show(Tenant $tenant): JsonResponse
    {
        return $this->responder->success($tenant, TenantTransformer::class)->respond();
    }

    public function update(TenantUpdateRequest $request, Tenant $tenant): JsonResponse
    {
        $tenant = $this->tenantService->updateTenant($request->validated(), $tenant);

        return $this->responder->success($tenant, TenantTransformer::class)->meta(['message' => 'Tenant Updated'])->respond();
    }

    public function destroy(Tenant $tenant): JsonResponse
    {
        $this->tenantService->destroyTenant($tenant);

        return $this->responder->success()->meta(['message' => 'Tenant Deleted'])->respond();
    }
}
