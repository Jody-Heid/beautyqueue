<?php

namespace App\Transformers;

use App\Models\Appointment;
use Flugg\Responder\Transformers\Transformer;

class AppointmentTransformer extends Transformer
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
        'customer' => UserTransformer::class,
        'staff' => UserTransformer::class,
        'service' => OfferedServiceTransformer::class,
    ];

    /**
     * Transform the model.
     *
     * @return array
     */
    public function transform(Appointment $appointment)
    {
        return [
            'id' => (int) $appointment->id,
            'appointment_date' => $appointment->appointment_date,
            'status' => $appointment->status,
        ];
    }
}
