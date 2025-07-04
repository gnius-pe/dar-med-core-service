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

    /**
     * Get custom messages for validator errors.
     *
     * @return array
     */
    public function messages(): array
    {
        return [
            // Tipo de identificación
            'identification_type.required' => 'El tipo de identificación es obligatorio.',
            'identification_type.in' => 'El tipo de identificación debe ser DNI o PPT.',
            
            // Número de identificación
            'identification_number.required' => 'El número de identificación es obligatorio.',
            'identification_number.string' => 'El número de identificación debe ser un texto válido.',
            'identification_number.unique' => 'El número de identificación ya está registrado.',
            
            // Nombre
            'first_name.required' => 'El nombre es obligatorio.',
            'first_name.string' => 'El nombre debe ser un texto válido.',
            'first_name.max' => 'El nombre no puede tener más de 255 caracteres.',
            
            // Apellido
            'last_name.required' => 'El apellido es obligatorio.',
            'last_name.string' => 'El apellido debe ser un texto válido.',
            'last_name.max' => 'El apellido no puede tener más de 255 caracteres.',
            
            // Email
            'email.email' => 'El correo electrónico debe tener un formato válido.',
            'email.unique' => 'El correo electrónico ya está registrado.',
            
            // Fecha de nacimiento
            'birth_date.required' => 'La fecha de nacimiento es obligatoria.',
            'birth_date.date' => 'La fecha de nacimiento debe ser una fecha válida.',
            
            // Teléfono principal
            'first_phone.required' => 'El teléfono principal es obligatorio.',
            'first_phone.string' => 'El teléfono principal debe ser un texto válido.',
            'first_phone.max' => 'El teléfono principal no puede tener más de 20 caracteres.',
            
            // Teléfono secundario
            'second_phone.string' => 'El teléfono secundario debe ser un texto válido.',
            'second_phone.max' => 'El teléfono secundario no puede tener más de 20 caracteres.',
            
            // Género
            'gender.required' => 'El género es obligatorio.',
            'gender.in' => 'El género debe ser Masculino (M), Femenino (F) o No especificado (NONE).',
            
            // Mensaje
            'message.string' => 'El mensaje debe ser un texto válido.',
            
            // Examen médico
            'medical_examination.boolean' => 'El examen médico debe ser verdadero o falso.',
            
            // Apoyo espiritual
            'spiritual_support.boolean' => 'El apoyo espiritual debe ser verdadero o falso.',
            
            // Permiso para llamar
            'permission_to_call.boolean' => 'El permiso para llamar debe ser verdadero o falso.',
            
            // Condición de visita
            'visit_condition.in' => 'La condición de visita debe ser urgente, programada o inactiva.',
            
            // Diagnóstico espiritual
            'spiritual_diagnosis.string' => 'El diagnóstico espiritual debe ser un texto válido.',
        ];
    }

    /**
     * Get custom attributes for validator errors.
     *
     * @return array
     */
    public function attributes(): array
    {
        return [
            'identification_type' => 'tipo de identificación',
            'identification_number' => 'número de identificación',
            'first_name' => 'nombre',
            'last_name' => 'apellido',
            'email' => 'correo electrónico',
            'birth_date' => 'fecha de nacimiento',
            'first_phone' => 'teléfono principal',
            'second_phone' => 'teléfono secundario',
            'gender' => 'género',
            'message' => 'mensaje',
            'medical_examination' => 'examen médico',
            'spiritual_support' => 'apoyo espiritual',
            'permission_to_call' => 'permiso para llamar',
            'visit_condition' => 'condición de visita',
            'spiritual_diagnosis' => 'diagnóstico espiritual',
        ];
    }
}