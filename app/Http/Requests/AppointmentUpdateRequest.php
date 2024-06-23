<?php

namespace App\Http\Requests;

use App\Rules\CustomerRole;
use App\Rules\StaffRole;
use App\Traits\ApiResponseHelpers;
use Illuminate\Contracts\Validation\Validator;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;
use Illuminate\Validation\ValidationException;

class AppointmentUpdateRequest extends FormRequest
{
    use ApiResponseHelpers;

    /**
     * Determine if the user is authorized to make this request.
     */
    public function authorize(): bool
    {
        return $this->user()->hasRole('admin');
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, \Illuminate\Contracts\Validation\ValidationRule|array<mixed>|string>
     */
    public function rules(): array
    {
        return [
            'customer_id' => ['required', 'numeric', Rule::exists('users', 'id')->withoutTrashed(), new CustomerRole],
            'staff_id' => ['required', 'numeric', Rule::exists('users', 'id')->withoutTrashed(), new StaffRole],
            'offered_service_id' => ['required', 'numeric', Rule::exists('offered_services', 'id')->withoutTrashed()],
            'appointment_date' => ['required', 'date_format:Y-m-d H:i:s'],
        ];
    }

    public function messages()
    {
        return [
            'customer_id.required' => 'A customer is required.',
            'customer_id.exists' => 'The selected customer does not exist.',
            'staff_id.required' => 'A staff member is required.',
            'staff_id.exists' => 'The selected staff member does not exist.',
            'appointment_date.required' => 'The appointment date is required.',
            'appointment_date.date_format' => 'The appointment date must be in the format Y-m-d H:i:s.',
            'offered_service_id.required' => 'A service is required.',
            'offered_service_id.exists' => 'The selected offered service does not exist.',
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
