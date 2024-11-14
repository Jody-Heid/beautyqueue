<?php

namespace App\Http\Controllers\API\V1;

use App\Http\Controllers\Controller;
use App\Http\Requests\StaffCreateRequest;
use App\Http\Requests\StaffUpdateRequest;
use App\Models\Staff;
use App\Services\StaffService;
use App\Transformers\StaffTransformer;
use Flugg\Responder\Responder;
use Illuminate\Http\JsonResponse;

class StaffController extends Controller
{
    public function __construct(
        private readonly StaffService $staffService,
        private readonly Responder $responder
    ) {
        $this->authorizeResource(Staff::class, 'staff');
    }

    public function index(): JsonResponse
    {
        $staff = $this->staffService->listStaff();

        return $staff->isEmpty()
            ? $this->responder->success($staff)->meta(['message' => 'No Staff Found'])->respond()
            : $this->responder->success($staff, StaffTransformer::class)->respond();
    }

    public function show(Staff $staff): JsonResponse
    {
        return $this->responder->success($staff, StaffTransformer::class)->respond();
    }

    public function store(StaffCreateRequest $request): JsonResponse
    {
        $staff = $this->staffService->createStaff($validatedData = $request->validated());

        $staff->assignRole($validatedData['role']);

        if (! blank($validatedData['permissions'])) {
            $staff->syncPermissions($validatedData['permissions']);
        }

        return $this->responder->success($staff, StaffTransformer::class)->meta(['message' => 'Staff Created'])->respond();
    }

    public function update(StaffUpdateRequest $request, Staff $staff): JsonResponse
    {
        $staff = $this->staffService->updateStaff($request->validated(), $staff);

        return $this->responder->success($staff, StaffTransformer::class)->meta(['message' => 'Staff Updated'])->respond();
    }

    public function destroy(Staff $staff): JsonResponse
    {
        $this->staffService->destroyStaff($staff);

        return $this->responder->success()->meta(['message' => 'Staff Deleted'])->respond();
    }
}
