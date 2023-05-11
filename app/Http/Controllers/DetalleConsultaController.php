<?php

namespace App\Http\Controllers;

use App\Http\Requests\DetalleConsulta\CreateRequest;
use App\Models\DetalleConsulta;
use Illuminate\Http\Request;

class DetalleConsultaController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        //Alamcenamos en la variable $detalle la consulta por orden descendente mediante id
        $detalle = DetalleConsulta::orderBy('id','desc')->get();

        //Retorna por un JSON todos los registros existentes en la base de datos
        return response()->json($detalle);

        //Verificamos que existan registros en la base de datos
        if ($detalle->count() == 0) {
            return response()->json([
                'Status' => false,
                'Message' => 'No existen registros aún...'
            ], 400);
        }
    }


    /**
     * Show the form for creating a new resource.
     */
    public function store(CreateRequest $request)
    {
        $detalle = new DetalleConsulta($request->all());
        $detalle->save();

        return response()->json([
            'Status' => true,
            'Message' => 'Detalle Consulta creado con éxito!'
        ], 200);
    }

    /**
     * Display the specified resource.
     */
    public function show($id)
    {   
        //Busqueda por id
        $detalle = DetalleConsulta::findOrfail($id);
        return response()->json($detalle);

        //Condición en caso no exista este Id
        if ($detalle->count() == 0 ) {
            return response()->json(['Registro no encontrado'], 400);
        }
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(CreateRequest $request, String $id)
    {
        $detalle = DetalleConsulta::findOrfail($id);
        $detalle->update($request->all());

        //si todo ok. Mensaje
        return response()->json([
            'Status'=> true,
            'Message' => $detalle
        ], 200);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(String $id)
    {
        $detalle = DetalleConsulta::findOrfail($id);
        $detalle->delete();
        
        //Mensaje 
        return response()->json([
            'status' => true,
            'Message' => 'Eliminado correctamente'
        ], 200);
    }
}
