<?php

namespace App\Http\Requests;

use App\Enums\AppointmentStatus;
use App\Traits\ApiResponseHelpers;
use Illuminate\Contracts\Validation\Validator;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\ValidationException;

class AppointmentUpdateRequest extends FormRequest
{
    use ApiResponseHelpers;

    /**
     * Determine if the user is authorized to make this request.
     */
    public function authorize(): bool
    {
        return $this->user()->can('update_appointments', 'update_any_appointments');
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, \Illuminate\Contracts\Validation\ValidationRule|array<mixed>|string>
     */
    public function rules(): array
    {
        return [
            'tenant_id' => 'sometimes|integer|exists:tenants,id',
            'user_id' => 'sometimes|integer|exists:users,id',
            'service_id' => 'sometimes|integer|exists:services,id',
            'appointment_date' => 'sometimes|date|after_or_equal:today',
            'appointment_time' => 'sometimes|date_format:H:i',
            'notes' => 'nullable|string',
            'rating' => 'nullable|integer|min:1|max:5',
            'status' => 'sometimes|string|in:'.implode(',', AppointmentStatus::values()),
        ];
    }

    protected function failedValidation(Validator $validator)
    {

        if ($this->wantsJson()) {
            $response = $this->respondFailedValidation($validator->errors()->first());
        }

        throw (new ValidationException($validator, $response))
            ->errorBag($this->errorBag)
            ->redirectTo($this->getRedirectUrl());
    }
}
