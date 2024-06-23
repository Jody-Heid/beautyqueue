<?php

namespace App\Http\Controllers\API\V1;

use App\Http\Controllers\Controller;
use App\Http\Requests\AppointmentStatusRequest;
use App\Models\Appointment;
use App\Services\AppointmentService;
use App\Transformers\AppointmentTransformer;
use Flugg\Responder\Responder;

class AppointmentStatusController extends Controller
{
    public function __construct(
        protected AppointmentService $appointmentService,
        protected Responder $responder,
    ) {
    }

    public function changeAppointmentStatus(AppointmentStatusRequest $request, Appointment $appointment)
    {
        $this->authorize('changeAppointmentStatus', $appointment);

        $appointment = $this->appointmentService->updateAppointmentStatus($request->validated('status'), $appointment);

        return $this->responder->success($appointment, AppointmentTransformer::class)->meta(['message' => 'Appointment Updated'])
            ->respond();
    }
}
