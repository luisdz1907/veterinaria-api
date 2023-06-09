<?php

namespace App\Http\Controllers;

use App\Http\Requests\Medico\CreateRequest;
use App\Models\Medico;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator as FacadesValidator;

class MedicoController extends Controller
{
    public function getAllMedico()
    {
        $medico = Medico::all();
        if ($medico->count() == 0) {
            return response()->json(['message' => 'No existen medicos registrados'], 200);
        }

        return response()->json($medico);
    }


    public function postCreateMedico(CreateRequest $request)
    {
        $medico = new Medico($request->all());
        $medico->save();
        return response()->json([
            'status' => true,
            'message' => 'Medico creado'
        ], 200);
    }



    public function putUpdateMedico(CreateRequest $request, String $id)
    {
        //Buscamos el Id que se actualizará 
        $medico = Medico::findOrfail($id);
        //Actualizamos
        $medico->update($request->all());

        //Mensaje Exito
        return response()->json([
            'status' => true,
            'message' => $medico
        ], 200);
    }


    public function deleteMedico(string $id)
    {
        $medico = Medico::findOrFail($id);
        $medico->delete();
        return response()->json([
            'status' => true,
            'message' => 'Medico eliminado'
        ], 200);
    }

}
