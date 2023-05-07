<?php

namespace App\Http\Controllers;

use App\Http\Requests\Cliente\CreateRequest;
use App\Models\Cliente;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator as FacadesValidator;

class ClienteController extends Controller
{

    public function getAllClientes()
    {
        $clientes = Cliente::orderBy('id', 'desc')->get();

        if ($clientes->count() == 0) {
            return response()->json(['message' => 'No existen clientes registrados'], 200);
        }

        return response()->json($clientes);
    }

    public function show($id)
    {
        $cliente = Cliente::findOrfail($id);
        return response()->json($cliente);

        if ($cliente->count() == 0) {
            return response()->json(['No encontrado'],400);
        }
    }

    public function postCreateUser(CreateRequest $request)
    {
        $cliente = new Cliente($request->all());
        $cliente->save();

        return response()->json([
            'status' => true,
            'message' => 'Cliente creado'
        ], 201);
    }



    public function putcliente(CreateRequest $request, string $id)
    { 
        //Actualizamos el cliente
        $cliente = Cliente::findOrfail($id);   
        
        $cliente->update($request->all());
        
        //Mensaje retornando la actualizacion
        return response()->json([
            'status' => true,
            'message' => 'cliente actualizado',
            'cliente : ' => $cliente
        ], 200);
        

}
    public function deleteCliente(string $id)
    {
        $cliente = Cliente::findOrFail($id);
        $cliente->delete();
        
        return response()->json([
            'status' => true,
            'message' => 'Cliente eliminado'
        ], 200);
    }
}
