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
        ], 201);
    }



    public function update(Request $request, string $id)
    {
        //Validaciones
        $rules = [
            'nombres' => 'require|min:1',
            'apellidos' => 'require|min:1',
            'identificacion' => 'require|min:1',
            'telefono' => 'require|min:1',
            'email' => 'require|min:1|email',
            'direccion' => 'require|min:1',
        ];

        $validated = FacadesValidator::make($request->all(), $rules);
        //mensaje error en validaciones
        if ($validated->fails()) {
            return response()->json([
                'status' => false,
                'errors' => $validated->errors()->all()
            ], 400);
        }
        
        //Actualizamos el cliente y retornamos un mensaje de exito
        $cliente = Cliente::findOrfail($id);   
        $cliente->update($request->only(['nombres','apellidos','identificacion', 'telefono','email','direccion']));
        return response()->json([
            'status' => true,
            'message' => $cliente
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
