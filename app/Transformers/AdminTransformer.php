<?php

namespace App\Transformers;

use App\Models\Admin;
use Flugg\Responder\Transformers\Transformer;

class AdminTransformer extends Transformer
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
    public function transform(Admin $admin): array
    {
        return [
            'name' => $admin->name,
            'email' => $admin->email,
            'cellphone_number' => $admin->cellphone_number,
        ];
    }
}
