<?php

namespace App\Http\Requests\Cliente;

use Illuminate\Contracts\Validation\Validator;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Http\Exceptions\HttpResponseException;

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
            'nombres' => 'required|min:5',
            'apellidos' => 'required|min:10',
            'identificacion' => 'required|min:5',
            'telefono' => 'required|min:10',
            'email' => 'required|min:5|email',
            'direccion' => 'required|min:1'
        ];
    }

    public function message(){
        return[
        'nombres.required' => 'Campo Obligatorio',
        'apellidos.required' => 'Campo Obligatorio',
        'identificacion.required' => 'Campo Obligatorio',
        'telefono.required' => 'Campo Obligatorio',
        'email.required' => 'Campo Obligatorio',
        'direccion.required' => 'Campo Obligatorio'];
    }

    public function failedValidation(Validator $validator)
    {
        throw new HttpResponseException(response()->json([
            'Status' => false,
            'Message' => $validator->errors()
        ],400));
    }
}
