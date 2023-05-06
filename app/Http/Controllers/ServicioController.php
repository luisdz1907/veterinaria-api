<?php

namespace App\Http\Controllers;

use App\Http\Requests\Servicio\CreateRequest;
use App\Models\Servicio;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator as FacadesValidator;

class ServicioController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function getAllServicio()
    {
        // dd('test');
        $Servicios = Servicio::orderBy('id', 'desc')->get();
        if ($Servicios->isEmpty()) {
            return response()->json([
                'Message' => 'No hay servicios registrados'
            ], 200);
        }

        return response()->json($Servicios);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function createservicio(CreateRequest $request)
    {
        $Servicio = new Servicio($request->all());
        $Servicio->save();

        return response()->json([
            'Status' => true,
            'Message' => '¡Servicio Creado Exitosamente!'
        ],200);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(CreateRequest $request, string $id)
    {
        // dd('test');
        $ActualizarServicio = Servicio::findOrfail($id);

        $ActualizarServicio->update($request->all());

        return response()->json([
            'status' => true,
            'message' => 'Servicio actualizado',
            'cliente : ' => $ActualizarServicio
        ], 200);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(String $id)
    {
        $ServicioDelete = Servicio::findOrfail($id);
        $ServicioDelete->delete();

        return response()->json([
            'status' => true,
            'Message' => 'Eliminado correctamente'
        ]);
    }
}
