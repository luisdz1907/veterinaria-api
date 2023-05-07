<?php

namespace App\Http\Controllers;

use App\Models\Animal;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator as FacadesValidator;

class AnimalController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function getAllAnimal()
    {
        $animal = Animal::orderBy('id', 'desc')->get();
        return response()->json($animal);
        if ($animal->count() == 0) {
            return response()->json(['message' => 'No existen registros'],200);
        }
    }

    public function show($id)
    {
        $animal = Animal::findorfail($id);
        return response()->json($animal);
    }
    /**
     * Show the form for creating a new resource.
     */
    public function PostCreateAnimal(Request $request)
    {
        //Reglas para la validación
        $rules = [
        'raza'=> 'required',
        'nombres'=> 'required',
        'sexo'=> 'required',
        'peso'=> 'required',
        'color'=> 'required',
        'enfermedades'=> 'required',
        'alergias'=> 'required',
        'cirugias'=> 'required',
        'nro_partos'=> '',
        'esteril'=> 'required',
        'edad'=> 'min:1',
        'clientes_id'=> 'required',
        'tipo_animals_id' => 'required'
        ];
        //Creamos la validación
        $validated = FacadesValidator::make($request->all(), $rules);
        //Si no se cumple...
        if ($validated->fails()) {
            return response()->json([
                'status' => false,
                'errors'=> $validated->errors()->all()
            ],400);
        }

        //Despues de hacer las validaciones, procedemos a almacenar los datos en el modelo
        $animal = new Animal($request->all());
        $animal->save();
        //Si todo está Ok, retornamos un mensaje de OK
        return response()->json([
        'status' => true,
        'message' => $animal
        ]);
    }

    /**
     * Update the specified resource in storage.
     */
    public function putAnimal(Request $request, string $id)
    {
        
        //Validaciones
        $rules = [
        'raza'=> 'min:1',
        'nombres'=> 'min:1',
        'sexo'=> 'min:1',
        'peso'=> 'min:1',
        'color'=> 'min:1',
        'enfermedades'=> 'min:1',
        'alergias'=> 'min:1',
        'cirugias'=> 'min:1',
        'nro_partos'=> '',
        'esteril'=> 'min:1',
        'edad'=> 'min:1',
        'clientes_id'=> 'min:1',
        'tipo_animals_id' => 'min:1'
        ];

        $validated = FacadesValidator::make($request->all(), $rules);
               //mensaje error en validaciones
        if ($validated->fails()) {
            return response()->json([
                'status' => false,
                'errors' => $validated->errors()->all()
            ], 400);
        }

        //Actualizamos el medico y retornamos un mensaje de exito
        $Animal = Animal::findOrfail($id);   
        $AnimalActualizado = $Animal->update($request->all());
        return response()->json([
            'status' => true,
            'message' => $Animal
        ], 200);

    
    }

    public function deleteAnimal(string $id)
    {
        //Creamos una variable animal que almacene la busqueda del id a eliminar
        $Animal = Animal::findOrFail($id);
        $Animal->delete(); //eliminamos el id obtenido
        return response()->json([
            'status' => true,
            'message' => 'Animal eliminado correctamente'
        ], 200);
    }
}
