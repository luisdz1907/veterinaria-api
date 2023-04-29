<?php

namespace App\Http\Controllers;

use App\Models\TipoAnimal;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator as FacadesValidator;

class TipoAnimalController extends Controller
{
    public function getAllTipoAnimal(){
        $tipoAnimal = TipoAnimal::all();
        return response()->json($tipoAnimal);
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

        $tipoAnimal = new TipoAnimal($request->all());
        $tipoAnimal->save();

        return response()->json([
            'status' => true,
            'message' => 'Tipo de animal creado'
        ], 200);
    }
}
