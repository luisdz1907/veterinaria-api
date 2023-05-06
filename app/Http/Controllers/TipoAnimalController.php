<?php

namespace App\Http\Controllers;

use App\Http\Requests\TipoAnimal\CreateRequest;
use App\Models\TipoAnimal;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator as FacadesValidator;

class TipoAnimalController extends Controller
{
    public function getAllTipoAnimal()
    {
        $tipoanimal = TipoAnimal::orderBy('id', 'desc')->get();
        
        //Mensaje de error
        return response()->json($tipoanimal);
        if ($tipoanimal->count() == 0) {
            return response()->json(['message' => 'No existen registros'], 200);
        }

    }

    public function postCreateTipoAnimal(CreateRequest $request)
    {
        $tipoanimal = new TipoAnimal($request->all());
        $tipoanimal->save();

        //Mensaje de exito
        return response()->json([
            'status' => true,
            'message' => 'Tipo de animal creado'
        ], 200);

    }

    public function putTipoAnimal(CreateRequest $request, string $id)
    {
        //Actualizamos el tipo animal y retornamos un mensaje de exito
        $tipoAnimal = TipoAnimal::findOrfail($id);   
        //Actualizamos
        $tipoAnimal->update($request->all());

        //mensaje de exito
        return response()->json([
            'status' => true,
            'message' => $tipoAnimal
        ], 200);

    }

    public function deleteTipoAnimal(string $id)
    {
        $TipoAnimal = TipoAnimal::findOrFail($id);
        $TipoAnimal->delete();
        
        //Mensaje de exito
        return response()->json([
            'status' => true,
            'message' => 'Tipo de animal eliminado correctamente'
        ], 200);
    }
}
