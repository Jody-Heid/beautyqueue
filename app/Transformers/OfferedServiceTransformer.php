<?php

namespace App\Transformers;

use App\Models\OfferedService;
use Flugg\Responder\Transformers\Transformer;

class OfferedServiceTransformer extends Transformer
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
    protected $load = [];

    /**
     * Transform the model.
     *
     * @return array
     */
    public function transform(OfferedService $offeredService)
    {
        return [
            'name' => $offeredService->name,
            'description' => $offeredService->description,
            'price' => "R {$offeredService->price}",
            'estimated_time' => "{$offeredService->duration_minutes} minutes",
        ];
    }
}
