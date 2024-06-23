<?php

namespace App\Http\Controllers\API\V1;

use App\Http\Controllers\Controller;
use App\Http\Requests\ServiceStoreRequest;
use App\Http\Requests\ServiceUpdateRequest;
use App\Models\OfferedService;
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

    public function index(): JsonResponse
    {
        $services = $this->offeredServiceService->getAllOfferedServices();

        return $services->isEmpty()
            ? $this->responder->success()->meta(['message' => 'No Services Found'])->respond()
            : $this->responder->success($services, OfferedServiceTransformer::class)->respond();
    }

    public function store(ServiceStoreRequest $request): JsonResponse
    {
        $service = $this->offeredServiceService->createOfferedService($request->validated());

        return $this->responder->success($service, OfferedServiceTransformer::class)->meta(['message' => 'Service Created'])
            ->respond();
    }

    public function show(OfferedService $service): JsonResponse
    {
        return $this->responder->success($service, OfferedServiceTransformer::class)->respond();
    }

    public function update(ServiceUpdateRequest $request, OfferedService $service): JsonResponse
    {
        $service = $this->offeredServiceService->updateOfferedService($request->validated(), $service);

        return $this->responder->success($service, OfferedServiceTransformer::class)->meta(['message' => 'Service Updated'])
            ->respond();
    }

    public function destroy(OfferedService $service): JsonResponse
    {
        $this->offeredServiceService->deleteOfferedService($service);

        return $this->responder->success()->meta(['message' => 'Service Deleted'])->respond();
    }
}
