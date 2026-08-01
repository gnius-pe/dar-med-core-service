<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class MissionRequest extends FormRequest
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
        $rules = [
            'name' => 'required|string|max:80',
            'description' => 'required|string',
            'start_date' => 'required|date',
            'end_date' => 'required|date|after_or_equal:start_date',
            'state' => 'required|boolean',
        ];

        // Para actualización, hacer el nombre único excepto para el registro actual
        if ($this->isMethod('PUT') || $this->isMethod('PATCH')) {
            $rules['name'] = 'required|string|max:80|unique:missions,name,' . $this->route('mission')->id;
        } else {
            $rules['name'] = 'required|string|max:80|unique:missions,name';
        }

        return $rules;
    }

    /**
     * Get custom error messages for validation rules.
     */
    public function messages(): array
    {
        return [
            'name.required' => 'El nombre de la misión es obligatorio.',
            'name.unique' => 'Ya existe una misión con este nombre.',
            'name.max' => 'El nombre de la misión no puede exceder los 80 caracteres.',
            'description.required' => 'La descripción de la misión es obligatoria.',
            'start_date.required' => 'La fecha de inicio es obligatoria.',
            'start_date.date' => 'La fecha de inicio debe ser una fecha válida.',
            'end_date.required' => 'La fecha de fin es obligatoria.',
            'end_date.date' => 'La fecha de fin debe ser una fecha válida.',
            'end_date.after_or_equal' => 'La fecha de fin debe ser igual o posterior a la fecha de inicio.',
            'state.required' => 'El estado de la misión es obligatorio.',
            'state.boolean' => 'El estado de la misión debe ser verdadero o falso.',
        ];
    }
}
