<?php

namespace App\Transformers;

use App\Models\Appointment;
use Carbon\Carbon;
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
        'user' => UserTransformer::class,
        'tenant' => TenantTransformer::class,
        'service' => OfferedServiceTransformer::class,
    ];

    /**
     * Transform the model.
     *
     * @return array
     */
    public function transform(Appointment $appointment)
    {
        $appointment->refresh();

        return [
            'appointment_date' => $appointment->appointment_date,
            'appointment_time' => Carbon::createFromFormat('H:i:s', $appointment->appointment_time)->format('H:i A'),
            'status' => $appointment->status,
            'notes' => $appointment->notes,
        ];
    }
}
