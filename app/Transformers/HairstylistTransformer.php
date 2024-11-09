<?php

namespace App\Transformers;

use App\Models\Hairstylist;
use Flugg\Responder\Transformers\Transformer;

class HairstylistTransformer extends Transformer
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
    public function transform(Hairstylist $hairstylist): array
    {
        return [
            'name' => $hairstylist->name,
            'email' => $hairstylist->email,
            'cellphone_number' => $hairstylist->cellphone_number,
        ];
    }
}
