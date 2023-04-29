<?php

namespace App\Http\Controllers;

use App\Models\TipoAnimal;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator as FacadesValidator;

class TipoAnimalController extends Controller
{
    public function getAllTipoAnimal()
    {
        $tipoanimal = TipoAnimal::all();
        return response()->json($tipoanimal);
        if ($tipoanimal->count() == 0) {
            return response()->json(['message' => 'No existen registros'], 200);
        }
    }

    public function postCreateTipoAnimal(Request $request){
        $rules = [
            'nombre_tipo' => 'required'
        ];

        $validated = FacadesValidator::make($request->all(), $rules);
        
        if ($validated->fails()) {
            return response()->json([
                'status' => false,
                'errors' => $validated->errors()->all()
            ], 400);
        }

        $tipoanimal = new TipoAnimal($request->all());
        $tipoanimal->save();

        return response()->json([
            'status' => true,
            'message' => 'Tipo de animal creado'
        ], 200);
    }

    public function putTipoAnimal(Request $request, string $id)
    {
        
        //Validaciones
        $rules = [
            'nombre_tipo' => 'min:1'
        ];

        $validated = FacadesValidator::make($request->all(), $rules);
               //mensaje error en validaciones
        if ($validated->fails()) {
            return response()->json([
                'status' => false,
                'errors' => $validated->errors()->all()
            ], 400);
        }

        //Avtualizamos el medico y retornamos un mensaje de exito
        $tipoAnimal = TipoAnimal::findOrfail($id);   
        $TipoAnimalActualizado = $tipoAnimal->update($request->all());
        return response()->json([
            'status' => true,
            'message' => $tipoAnimal
        ], 200);

    }

    public function deleteTipoAnimal(string $id)
    {
        $TipoAnimal = TipoAnimal::findOrFail($id);
        $TipoAnimal->delete();
        return response()->json([
            'status' => true,
            'message' => 'Tipo de animal eliminado correctamente'
        ], 200);
    }
}
