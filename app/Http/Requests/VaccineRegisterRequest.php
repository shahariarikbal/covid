<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class VaccineRegisterRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     */
    public function authorize(): bool
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, \Illuminate\Contracts\Validation\ValidationRule|array<mixed>|string>
     */
    public function rules(): array
    {
        return [
            'first_name' => 'required|string',
            'last_name' => 'required|string',
            'nid' => 'required|max:15|min:11|unique:vaccinations,nid',
            'center_id' => 'required|integer',
            'vaccine_date' => 'required|date',
            'email' => 'required|email|unique:vaccinations,email',
            'phone' => 'required|unique:vaccinations,phone',
        ];
    }

    public function messages(): array
    {
        return [
            'first_name.required' => 'The first name is required.',
            'first_name.string' => 'The first name must be a valid string.',
            'last_name.required' => 'The last name is required.',
            'last_name.string' => 'The last name must be a valid string.',
            'nid.required' => 'Your National ID (NID) is required.',
            'nid.integer' => 'The National ID must be a valid number.',
            'nid.unique' => 'The National ID has already been used for registration.',
            'center_id.required' => 'Please select a vaccination center.',
            'center_id.integer' => 'The vaccination center ID must be a valid number.',
            'email.required' => 'The email address is required.',
            'email.email' => 'Please provide a valid email address.',
            'email.unique' => 'The email address has already been used for registration.',
            'phone.required' => 'The phone number is required.',
            'phone.unique' => 'The phone number has already been used for registration.',
            'vaccine_date.required' => 'The vaccine date is required.',
            'vaccine_date.date' => 'Please provide a valid date for the vaccine.',
        ];
    }

}
