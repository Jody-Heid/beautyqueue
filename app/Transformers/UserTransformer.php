<?php

namespace App\Transformers;

use App\Models\User;
use Flugg\Responder\Transformers\Transformer;

class UserTransformer extends Transformer
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
    public function transform(User $user): array
    {
        return [
            'name' => $user->name,
            'email' => $user->email,
            'cellphone_number' => $user->cellphone_number,
            'role' => $user->getRoleNames(),
        ];
    }
}
