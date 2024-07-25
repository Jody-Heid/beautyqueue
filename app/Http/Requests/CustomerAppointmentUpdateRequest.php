<?php

namespace App\Http\Requests;

use App\Traits\ApiResponseHelpers;
use Illuminate\Contracts\Validation\Validator;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\ValidationException;

class CustomerAppointmentUpdateRequest extends FormRequest
{
    use ApiResponseHelpers;

    /**
     * Determine if the user is authorized to make this request.
     */
    public function authorize(): bool
    {
        return $this->user()->customer()->exists();
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, \Illuminate\Contracts\Validation\ValidationRule|array<mixed>|string>
     */
    public function rules(): array
    {
        return [
            'appointment_date' => ['required', 'date_format:Y-m-d'],
            'appointment_time' => ['required', 'date_format:H:i'],
        ];
    }

    public function messages()
    {
        return [
            'appointment_date.required' => 'The appointment date is required.',
            'appointment_date.date_format' => 'The appointment date must be in the format Y-m-d H:i:s.',
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
