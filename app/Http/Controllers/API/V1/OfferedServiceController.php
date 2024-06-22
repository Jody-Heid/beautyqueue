<?php

namespace App\Http\Controllers\API\V1;

use App\Http\Controllers\Controller;
use App\Http\Requests\ServiceStoreRequest;
use App\Http\Requests\ServiceUpdateRequest;
use App\Models\OfferedService;
use App\Repositories\OfferedServiceRepository;
use App\Transformers\OfferedServiceTransformer;
use Flugg\Responder\Http\Responses\SuccessResponseBuilder;
use Flugg\Responder\Responder;

class OfferedServiceController extends Controller
{
    public function __construct(private readonly OfferedServiceRepository $offeredServiceRepository,
        private readonly Responder $responder
    ) {
        $this->authorizeResource(OfferedService::class, 'service');
    }

    public function index(): SuccessResponseBuilder
    {
        $services = $this->offeredServiceRepository->getAllOfferedServices();

        return $services->isEmpty()
            ? $this->responder->success()->meta(['message' => 'No Services Found'])
            : $this->responder->success($services, OfferedServiceTransformer::class);
    }

    public function store(ServiceStoreRequest $request): SuccessResponseBuilder
    {
        $service = $this->offeredServiceRepository->createOfferedService($request->validated());

        return $this->responder->success($service, OfferedServiceTransformer::class)->meta(['message' => 'Service Created']);
    }

    public function show(OfferedService $service): SuccessResponseBuilder
    {
        return $this->responder->success($service, OfferedServiceTransformer::class);
    }

    public function update(ServiceUpdateRequest $request, OfferedService $service): SuccessResponseBuilder
    {
        $service = $this->offeredServiceRepository->updateOfferedService($request->validated(), $service);

        return $this->responder->success($service, OfferedServiceTransformer::class)->meta(['message' => 'Service Updated']);
    }

    public function destroy(OfferedService $service): SuccessResponseBuilder
    {
        $this->offeredServiceRepository->deleteOfferedService($service);

        return $this->responder->success()->meta(['message' => 'Service Deleted']);
    }
}
