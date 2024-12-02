<?php

namespace App\Repositories;

use App\Interface\CategoryRepositoryInterface;
use App\Models\Category;
use Illuminate\Database\Eloquent\Collection;

class CategoryRepository implements CategoryRepositoryInterface
{
    public function getAllCategories(int $tenantId): Collection
    {
        return Category::where('tenant_id', $tenantId)
            ->orderBy('display_order')
            ->get();
    }

    public function getCategoryById(int|string $id): Category
    {
        return Category::findOrFail($id);
    }

    public function getCategoryBySlug(string $slug, int $tenantId): ?Category
    {
        return Category::where('tenant_id', $tenantId)
            ->where('slug', $slug)
            ->first();
    }

    public function createCategory(array $categoryDetails): Category
    {
        return Category::create($categoryDetails);
    }

    public function updateCategory(array $newDetails, Category $category): Category
    {
        $category->update($newDetails);
        $category->refresh();

        return $category;
    }

    public function deleteCategory(Category $category): void
    {
        $category->delete();
    }

    public function getActiveCategories(int $tenantId): Collection
    {
        return Category::where('tenant_id', $tenantId)
            ->where('is_active', true)
            ->orderBy('display_order')
            ->get();
    }
}