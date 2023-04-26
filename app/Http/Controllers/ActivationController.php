<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;

class ActivationController extends Controller
{
    public function activate(string $token)
    {
        $user = DB::table('users')->where('activated', $token)->first();
        if (!$user) {
            return response()->json([
                'status' => false,
                'errors' => 'Ocurrio un error al verfificar la cuenta'
            ], 400);
        }

        DB::table('users')
            ->where('id', $user->id)
            ->update(['activated' => true, 'activated' => null]);

        Auth::loginUsingId($user->id);


        return response()->json([
            "status" => true,
            "message" => 'Tu cuenta ha sido activada satisfactoriamente!'
        ]);
    }
}
