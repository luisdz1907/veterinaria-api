<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\ClienteController;
use App\Http\Controllers\MedicoController;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "api" middleware group. Make something great!
|
*/

// Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
//     return $request->user();
// });



Route::group([
    'middleware' => 'api',
    'prefix' => 'auth'
], function ($router) {
    Route::post('/login', [AuthController::class, 'login']);
    Route::post('/register', [AuthController::class, 'register']);
    // Route::post('/refresh', [AuthController::class, 'refresh']);
});

Route::group(['middleware' => ['jwt.verify']], function(){
    //Cliente
    Route::post('cliente',[ClienteController::class, 'postCreateUser']);
    Route::get('cliente',[ClienteController::class, 'getAllClientes']);
    //Route::patch('cliente',[ClienteController::class, 'putCliente']);
    Route::delete('cliente/{id}',[ClienteController::class, 'deleteCliente']);


    Route::get('/user-profile', [AuthController::class, 'userProfile']);
    Route::post('/logout', [AuthController::class, 'logout']);
    
    route::post('medico',[MedicoController::class, 'postCreateMedico']);
    route::get('medico',[MedicoController::class, 'getAllMedico']);
   // route::get('medico',[MedicoController::class, 'getAllMedico']);
    route::delete('medico/{id}',[MedicoController::class, 'deleteMedico']);


});
