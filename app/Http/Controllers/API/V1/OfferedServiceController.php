<?php

namespace App\Http\Controllers\API\V1;

use App\Http\Controllers\Controller;
use App\Http\Requests\ServiceStoreRequest;
use App\Http\Requests\ServiceUpdateRequest;
use App\Models\OfferedService;
use App\Models\Service;
use App\Models\Tenant;
use App\Services\OfferedServiceService;
use App\Transformers\OfferedServiceTransformer;
use Flugg\Responder\Responder;
use Illuminate\Http\JsonResponse;

class OfferedServiceController extends Controller
{
    public function __construct(
        private readonly OfferedServiceService $offeredServiceService,
        private readonly Responder $responder,
    ) {
        $this->authorizeResource(OfferedService::class, 'service');
    }

    public function index(Tenant $tenant): JsonResponse
    {
        $services = $this->offeredServiceService->listServices($tenant->id);

        return $services->isEmpty()
            ? $this->responder->success()->meta(['message' => 'No Services Found'])->respond()
            : $this->responder->success($services, OfferedServiceTransformer::class)->respond();
    }

    public function store(ServiceStoreRequest $request, Tenant $tenant): JsonResponse
    {
        $validatedData = $request->validated();
        $validatedData['tenant_id'] = $tenant->id;

        $service = $this->offeredServiceService->createService($validatedData);

        return $this->responder->success($service, OfferedServiceTransformer::class)
            ->meta(['message' => 'Service Created'])
            ->respond();
    }

    public function show(Tenant $tenant, OfferedService $service): JsonResponse
    {
        return $this->responder->success($service, OfferedServiceTransformer::class)->respond();
    }

    public function update(ServiceUpdateRequest $request, Tenant $tenant, OfferedService $service): JsonResponse
    {
        $validatedData = $request->validated();
        $service = $this->offeredServiceService->updateService($validatedData, $service);

        return $this->responder->success($service, OfferedServiceTransformer::class)
            ->meta(['message' => 'Service Updated'])
            ->respond();
    }

    public function destroy(Tenant $tenant, OfferedService $service): JsonResponse
    {
        $this->offeredServiceService->destroyService($service);

        return $this->responder->success()
            ->meta(['message' => 'Service Deleted'])
            ->respond();
    }

    public function byCategory(Tenant $tenant, int $categoryId): JsonResponse
    {
        $services = $this->offeredServiceService->getServicesByCategory($categoryId, $tenant->id);

        return $services->isEmpty()
            ? $this->responder->success()->meta(['message' => 'No Services Found in Category'])->respond()
            : $this->responder->success($services, OfferedServiceTransformer::class)->respond();
    }
}