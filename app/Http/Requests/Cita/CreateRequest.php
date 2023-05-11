<?php

namespace App\Http\Requests\Cita;

use Illuminate\Foundation\Http\FormRequest;

class CreateRequest extends FormRequest
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
     * @return array<string, \Illuminate\Contracts\Validation\ValidationRule|array|string>
     */
    public function rules(): array
    {
        return [
            'asunto' => 'required|min:5',
            'fecha_agenda' => 'required',
            'animals_id' => 'required',
            'medico_id' => 'required',
            'servicio_id' => 'required'
        ];
    }

    public function message () {
    return [
        'asunto.required' => 'El campo es obligatorio',
        'fecha_agenda.required' => 'El campo es obligatorio',
        'animals_id.required' => 'El campo es obligatorio',
        'medico_id.required' => 'El campo es obligatorio',
        'servicio_id.required' => 'El campo es obligatorio'
    ];
    }
}
