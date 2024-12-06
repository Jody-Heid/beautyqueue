<?php

namespace App\Transformers;

use App\Models\User;
use App\Models\Category;
use Flugg\Responder\Transformers\Transformer;

class CategoryTransformer extends Transformer
{
    /**
     * List of available relations.
     *
     * @var string[]
     */
    protected $relations = [];

    /**
     * List of autoloaded default relations.
     *
     * @var array
     */
    protected $load = [
    ];

    /**
     * Transform the model.
     */
    public function transform(Category $category): array
    {
        return [
            'id' => (int) $category->id,
            'tenant_id' => (int) $category->tenant_id,
            'name' => $category->name,
            'slug' => $category->slug,
            'description' => $category->description,
            'is_active' => (bool) $category->is_active,
            'display_order' => (int) $category->display_order,
            'services_count' => $category->services()->count(),
            'created_at' => $category->created_at->toISOString(),
            'updated_at' => $category->updated_at->toISOString(),
        ];
    }
}
