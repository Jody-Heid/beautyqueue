<?php

namespace App\Transformers;

use App\Models\Tenant;
use Flugg\Responder\Transformers\Transformer;

class TenantTransformer extends Transformer
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
     */
    public function transform(Tenant $tenant): array
    {
        return [
            'name' => $tenant->name,
            'email' => $tenant->email,
            'address' => $tenant->address,
            'phone_number' => $tenant->phone_number,
            'active_users' => $tenant->users()->count()
        ];
    }
}
