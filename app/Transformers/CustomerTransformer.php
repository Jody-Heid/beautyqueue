<?php

namespace App\Transformers;

use App\Models\Customer;
use Flugg\Responder\Transformers\Transformer;

class CustomerTransformer extends Transformer
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
    public function transform(Customer $customer): array
    {
        return [
            'id' => (int) $customer->id,
            'name' => $customer->name,
            'email' => $customer->email,
            'cellphone_number' => $customer->cellphone_number,
        ];
    }
}
