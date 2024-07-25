<?php

namespace App\Http\Controllers\API\V1;

use App\Http\Controllers\Controller;
use App\Http\Requests\AppointmentStoreRequest;
use App\Http\Requests\AppointmentUpdateRequest;
use App\Models\Appointment;
use App\Services\AppointmentService;
use App\Transformers\AppointmentTransformer;
use Flugg\Responder\Responder;
use Illuminate\Http\JsonResponse;
use Illuminate\Support\Facades\Log;
use Throwable;

class AppointmentController extends Controller
{
    public function __construct(
        private readonly AppointmentService $appointmentService,
        private readonly Responder $responder,
    ) {
        $this->authorizeResource(Appointment::class, 'appointement');
    }

    public function index(): JsonResponse
    {
        try {
            $user = request()->user();

            $appointments = $this->appointmentService->getAppointments($user);

            return $appointments->isEmpty()
                ? $this->responder->success()->meta(['message' => 'No Appointments Found'])->respond()
                : $this->responder->success($appointments, AppointmentTransformer::class)->respond();

        } catch (Throwable $e) {
            Log::error('Something went wrong getting appointments: ', [$e]);

            return $this->responder->error('Appointment Error', 'Something went wrong while getting the appointments. Please try again.')->respond(500);
        }
    }

    public function store(AppointmentStoreRequest $request): JsonResponse
    {
        $appointment = $this->appointmentService->createAppointment($request->validated());

        return $this->responder->success($appointment, AppointmentTransformer::class)->meta(['message' => 'Appointment Created'])
            ->respond();
    }

    public function show(Appointment $appointment): JsonResponse
    {
        return $this->responder->success($appointment, AppointmentTransformer::class)->respond();
    }

    public function update(AppointmentUpdateRequest $request, Appointment $appointment): JsonResponse
    {
        $appointment = $this->appointmentService->updateAppointment($request->validated(), $appointment);

        return $this->responder->success($appointment, AppointmentTransformer::class)->meta(['message' => 'Appointment Updated'])
            ->respond();
    }

    public function destroy(Appointment $appointment): JsonResponse
    {
        $this->appointmentService->deleteAppointment($appointment);

        return $this->responder->success()->meta(['message' => 'Appointment Deleted'])->respond();
    }
}
