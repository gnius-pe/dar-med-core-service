<?php

namespace App\Http\Requests;

use Illuminate\Contracts\Validation\ValidationRule;
use Illuminate\Foundation\Http\FormRequest;

class PatientRequest extends FormRequest
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
     * @return array<string, ValidationRule|array|string>
     */
    public function rules(): array
    {
        $id = $this->route('id');

        return [
            'identification_type' => 'required|in:DNI,PPT',
            'identification_number' => "required|string|unique:patients,identification_number,{$id}",
            'first_name' => 'required|string|max:255',
            'last_name' => 'required|string|max:255',
            'email' => "nullable|email|unique:patients,email,{$id}",
            'birth_date' => 'required|date',
            'first_phone' => 'required|string|max:20',
            'second_phone' => 'nullable|string|max:20',
            'gender' => 'required|in:M,F,NONE',
            'message' => 'nullable|string',
            'medical_examination' => 'nullable|boolean',
            'spiritual_support' => 'nullable|boolean',
            'permission_to_call' => 'nullable|boolean',
            'visit_condition' => 'nullable|in:urgent,program,inactive',
            'spiritual_diagnosis' => 'nullable|string',
        ];
    }
}
