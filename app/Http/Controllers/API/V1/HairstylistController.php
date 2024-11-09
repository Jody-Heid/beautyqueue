<?php

namespace App\Http\Controllers\API\V1;

use App\Http\Controllers\Controller;
use App\Http\Requests\HairstylistCreateRequest;
use App\Http\Requests\HairstylistUpdateRequest;
use App\Models\Hairstylist;
use App\Services\HairstylistService;
use App\Transformers\HairstylistTransformer;
use Flugg\Responder\Responder;
use Spatie\Permission\Models\Permission;
use Spatie\Permission\Models\Role;

class HairstylistController extends Controller
{
    public function __construct(
        private readonly HairstylistService $hairstylistService,
        private readonly Responder $responder,
    ) {
        $this->authorizeResource(Hairstylist::class, 'hairstylist');
    }

    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $hairstylists = $this->hairstylistService->listHairstylists();

        return $hairstylists->isEmpty()
            ? $this->responder->success($hairstylists)->meta(['message' => 'No Hairstylists Found'])->respond()
            : $this->responder->success($hairstylists, HairstylistTransformer::class)->respond();
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(HairstylistCreateRequest $request)
    {

        $hairstylist = $this->hairstylistService->createHairstylist($request->validated());
        $hairstylist->assignRole(Role::findByName('hairstylist', 'api'));

        if (! blank($validatedPermissions = $request->validated('permissions'))) {
            $hairstylist->syncPermissions(Permission::whereIn('name', $validatedPermissions)->get());
        }

        return $this->responder->success($hairstylist, HairstylistTransformer::class)->meta(['message' => 'Hairstylist Created'])->respond();
    }

    /**
     * Display the specified resource.
     */
    public function show(Hairstylist $hairstylist)
    {
        return $this->responder->success($hairstylist, HairstylistTransformer::class)->respond();
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(HairstylistUpdateRequest $request, Hairstylist $hairstylist)
    {
        $hairstylist = $this->hairstylistService->updateHairstylist($request->validated(), $hairstylist);

        if (! blank($validatedPermissions = $request->validated('permissions'))) {
            $hairstylist->syncPermissions(Permission::whereIn('name', $validatedPermissions)->get());
        }

        return $this->responder->success($hairstylist, HairstylistTransformer::class)->meta(['message' => 'Hairstylist Updated'])->respond();
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Hairstylist $hairstylist)
    {
        $this->hairstylistService->destroyHairstylist($hairstylist);

        return $this->responder->success()->meta(['message' => 'Hairstylist Deleted'])->respond();
    }
}
