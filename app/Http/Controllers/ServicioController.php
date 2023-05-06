<?php

namespace App\Http\Controllers;

use App\Models\Servicio;
use Illuminate\Http\Request;

use function GuzzleHttp\Promise\all;

class ServicioController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $Servicio = Servicio::all();
        if ($Servicio->count()==0) {
            return response()->json([
                'Message' => 'No hay servicios registrados'
            ]);
        }
        return response()->json($Servicio, 200);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $Servicio = new Servicio($request->all());
        $Servicio->save();

        return response()->json([
            'Status' => true,
            'Message' => '¡Servicio Creado Exitosamente!'
        ]);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $ActualizarServicio = Servicio::finOrfail($id);
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
    public function destroy(Servicio $servicio)
    {
        //
    }
}
