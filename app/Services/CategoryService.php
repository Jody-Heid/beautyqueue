<?php

namespace App\Services;

use App\Interface\CategoryRepositoryInterface;
use App\Models\Category;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Support\Str;

class CategoryService
{
    public function __construct(
        private readonly CategoryRepositoryInterface $categoryRepository
    ) {
    }

    /**
     * List all categories for a tenant.
     */
    public function listCategories(int $tenantId): Collection
    {
        return $this->categoryRepository->getAllCategories($tenantId);
    }

    /**
     * Create a new category.
     */
    public function createCategory(array $categoryData): Category
    {
        if (!isset($categoryData['slug'])) {
            $categoryData['slug'] = Str::slug($categoryData['name']);
        }

        return $this->categoryRepository->createCategory($categoryData);
    }

    /**
     * Get a specific category by ID.
     */
    public function getCategoryById(string|int $id): Category
    {
        return $this->categoryRepository->getCategoryById($id);
    }

    /**
     * Get a specific category by slug.
     */
    public function getCategoryBySlug(string $slug, int $tenantId): ?Category
    {
        return $this->categoryRepository->getCategoryBySlug($slug, $tenantId);
    }

    /**
     * Update an existing category.
     */
    public function updateCategory(array $categoryData, Category $category): Category
    {
        if (
            isset($categoryData['name']) && 
            $categoryData['name'] !== $category->name && 
            !isset($categoryData['slug'])
        ) {
            $categoryData['slug'] = Str::slug($categoryData['name']);
        }

        return $this->categoryRepository->updateCategory($categoryData, $category);
    }

    /**
     * Delete a specific category.
     */
    public function destroyCategory(Category $category): void
    {
        $this->categoryRepository->deleteCategory($category);
    }

    /**
     * Get active categories for a tenant.
     */
    public function getActiveCategories(int $tenantId): Collection
    {
        return $this->categoryRepository->getActiveCategories($tenantId);
    }
}