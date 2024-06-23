<?php

namespace App\Http\Requests;

use App\Traits\ApiResponseHelpers;
use Illuminate\Contracts\Validation\Validator;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\ValidationException;

class UserUpdateRequest extends FormRequest
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
            'name' => 'required|string',
            'email' => 'required|email|max:255|unique:users,email,'.$this->user->id,
            'cellphone_number' => ['required', 'string', 'unique:users,cellphone_number,'.$this->user->id, 'regex:/^27[0-9]{9}$/'],
            'role_id' => 'required|numeric',
        ];
    }

    public function messages()
    {
        return [
            'cellphone_number.required' => 'The cellphone number is required.',
            'cellphone_number.regex' => 'The cellphone number must start with 27 and be followed by 9 digits.',
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
