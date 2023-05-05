<?php

namespace App\Http\Requests\Medico;

use Illuminate\Contracts\Validation\Validator;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Http\Exceptions\HttpResponseException;
use PhpParser\Node\Stmt\Return_;

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
            'nombre' => 'required|min:1',
            'apellidos' => 'required|min:1',
            'identificacion' => 'required|min:5',
            'celular' => 'required|min:1',
            'email' => 'required|min:1',
            'estado' => '',
            'direccion' => 'required|min:1'
        ];
    }

    public function message()
    {
        return [
            'nombre.required' => 'El campo es obligatorio',
            'apellidos.required' => 'El campo es obligatorio',
            'identificacion.required' => 'El campo es obligatorio',
            'celular.required' => 'El campo es obligatorio',
            'email.required' => 'El campo es obligatorio',
            'estado' => '',
            'direccion.required' => 'El campo es obligatorio'
        ];
    }

    public function failedValidation(Validator $validator)
    {
        throw new HttpResponseException(response()->json([
            'status' => false,
            'message' => $validator->errors()
        ],400));
    }
}
