<?php

namespace App\Http\Controllers;

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


    public function postCreateMedico(Request $request)
    {
        $rules = [
            'nombre' => 'required',
            'apellidos' => 'required',
            'celular' => 'required|min:10',
            'email' => 'required',
            'direccion' => 'required',
        ];

        $validated = FacadesValidator::make($request->all(), $rules);

        if ($validated->fails()) {
            return response()->json([
                'status' => false,
                'errors' => $validated->errors()->all()
            ], 400);
        }
        $medico = new Medico($request->all());
        $medico->save();
        return response()->json([
            'status' => true,
            'message' => 'Medico creado'
        ], 200);
    }



    public function putUpdateMedico(Request $request, Medico $cliente)
    {
        
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
