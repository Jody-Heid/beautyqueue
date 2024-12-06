<?php

namespace App\Interface;

use App\Models\Category;
use Illuminate\Database\Eloquent\Collection;

interface CategoryRepositoryInterface
{
    /**
     * Get all categories for a tenant
     */
    public function getAllCategories(int $tenantId): Collection;

    /**
     * Get a category by ID
     */
    public function getCategoryById(int|string $id): Category;

    /**
     * Get a category by slug
     */
    public function getCategoryBySlug(string $slug, int $tenantId): ?Category;

    /**
     * Create a new category
     */
    public function createCategory(array $categoryDetails): Category;

    /**
     * Update an existing category
     */
    public function updateCategory(array $newDetails, Category $category): Category;

    /**
     * Delete a category
     */
    public function deleteCategory(Category $category): void;

    /**
     * Get active categories for a tenant
     */
    public function getActiveCategories(int $tenantId): Collection;
}