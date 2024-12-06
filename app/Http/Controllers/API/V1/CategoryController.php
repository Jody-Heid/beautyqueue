<?php

namespace App\Http\Controllers\API\V1;

use App\Http\Controllers\Controller;
use App\Http\Requests\CategoryStoreRequest;
use App\Http\Requests\CategoryUpdateRequest;
use App\Models\Category;
use App\Models\Tenant;
use App\Services\CategoryService;
use App\Transformers\CategoryTransformer;
use Flugg\Responder\Responder;
use Illuminate\Http\JsonResponse;

class CategoryController extends Controller
{
    public function __construct(
        private readonly CategoryService $categoryService,
        private readonly Responder $responder
    ) {
        $this->authorizeResource(Category::class, 'category');
    }

    public function index(Tenant $tenant): JsonResponse
    {
        $categories = $this->categoryService->listCategories($tenant->id);

        return $categories->isEmpty()
            ? $this->responder->success()->meta(['message' => 'No Categories Found'])->respond()
            : $this->responder->success($categories, CategoryTransformer::class)->respond();
    }

    public function store(CategoryStoreRequest $request, Tenant $tenant): JsonResponse
    {
        $validatedData = $request->validated();
        $validatedData['tenant_id'] = $tenant->id;

        $category = $this->categoryService->createCategory($validatedData);

        return $this->responder->success($category, CategoryTransformer::class)
            ->meta(['message' => 'Category Created'])
            ->respond();
    }

    public function show(Tenant $tenant, Category $category): JsonResponse
    {
        return $this->responder->success($category, CategoryTransformer::class)->respond();
    }

    public function update(CategoryUpdateRequest $request, Tenant $tenant, Category $category): JsonResponse
    {
        $validatedData = $request->validated();
        
        $category = $this->categoryService->updateCategory($validatedData, $category);

        return $this->responder->success($category, CategoryTransformer::class)
            ->meta(['message' => 'Category Updated'])
            ->respond();
    }

    public function destroy(Tenant $tenant, Category $category): JsonResponse
    {
        $this->categoryService->destroyCategory($category);

        return $this->responder->success()
            ->meta(['message' => 'Category Deleted'])
            ->respond();
    }

    public function active(Tenant $tenant): JsonResponse
    {
        $categories = $this->categoryService->getActiveCategories($tenant->id);

        return $categories->isEmpty()
            ? $this->responder->success()->meta(['message' => 'No Active Categories Found'])->respond()
            : $this->responder->success($categories, CategoryTransformer::class)->respond();
    }
}