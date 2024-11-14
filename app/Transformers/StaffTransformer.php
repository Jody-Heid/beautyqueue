<?php

namespace App\Transformers;

use App\Models\Staff;
use Flugg\Responder\Transformers\Transformer;

class StaffTransformer extends Transformer
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
    public function transform(Staff $staff): array
    {
        return [
            'name' => $staff->name,
            'email' => $staff->email,
            'role' => $staff->getRoleNames(),
            'permissions' => $staff->getPermissionNames(),
        ];
    }
}
