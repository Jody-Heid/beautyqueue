<?php

namespace App\Http\Controllers\API\V1;

use App\Http\Controllers\Controller;
use App\Http\Requests\AdminCreateRequest;
use App\Http\Requests\AdminUpdateRequest;
use App\Models\Admin;
use App\Services\AdminService;
use App\Transformers\AdminTransformer;
use Flugg\Responder\Responder;

class AdminController extends Controller
{
    public function __construct(
        private readonly AdminService $adminService,
        private readonly Responder $responder,
    ) {
        $this->authorizeResource(Admin::class, 'admin');
    }

    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $admins = $this->adminService->listAdmins();

        return $admins->isEmpty()
            ? $this->responder->success($admins)->meta(['message' => 'No Admins Found'])->respond()
            : $this->responder->success($admins, AdminTransformer::class)->respond();
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(AdminCreateRequest $request)
    {
        $admin = $this->adminService->createAdmin($request->validated());

        $admin->assignRole('admin');

        return $this->responder->success($admin, AdminTransformer::class)->meta(['message' => 'Admin Created'])->respond();
    }

    /**
     * Display the specified resource.
     */
    public function show(Admin $admin)
    {
        return $this->responder->success($admin, AdminTransformer::class)->respond();
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(AdminUpdateRequest $request, Admin $admin)
    {
        $admin = $this->adminService->updateAdmin($request->validated(), $admin);

        return $this->responder->success($admin, AdminTransformer::class)->meta(['message' => 'Admin Updated'])->respond();
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Admin $admin)
    {
        $this->adminService->destroyAdmin($admin);

        return $this->responder->success()->meta(['message' => 'Admin Deleted'])->respond();
    }
}
