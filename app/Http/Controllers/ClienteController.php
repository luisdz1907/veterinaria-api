<?php

namespace App\Http\Controllers;

use App\Models\Cliente;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator as FacadesValidator;

class ClienteController extends Controller
{

    public function getAllClientes()
    {
        $clientes = Cliente::all();
        if ($clientes->count() == 0) {
            return response()->json(['message' => 'No existen clientes registardos'], 200);
        }

        return response()->json($clientes);
    }


    public function postCreateUser(Request $request)
    {
        $rules = [
            'nombres' => 'required',
            'apellidos' => 'required',
            'identificacion' => 'required',
            'telefono' => 'required',
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
        $cliente = new Cliente($request->all());
        $cliente->save();
        return response()->json([
            'status' => true,
            'message' => 'Cliente creado'
        ], 200);
    }



    public function putUpdateCliente(Request $request, Cliente $cliente)
    {

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
