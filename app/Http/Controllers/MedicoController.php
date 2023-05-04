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
            'celular' => 'required',
            'email' => 'required',
            'estado' => 'required',
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



    public function putUpdateMedico(Request $request, String $id)
    {
        //Validaciones
        $rules = [
            'nombre' => 'min:1',
            'apellidos' => 'min:1',
            'celular' => 'min:1',
            'email' => 'min:1',
            'estado' => 'min:1',
            'direccion' => 'min:1'
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
        $medico = Medico::findOrfail($id);   
        $medicoActualizado = $medico->update($request->all());
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
