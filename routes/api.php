<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\ClienteController;
use App\Http\Controllers\MedicoController;
use App\Http\Controllers\TipoAnimalController;


Route::group([
    'middleware' => 'api',
    'prefix' => 'auth'
], function ($router) {
    Route::post('/login', [AuthController::class, 'login']);
    Route::post('/register', [AuthController::class, 'register']);
});

Route::group(['middleware' => ['jwt.verify','upload']], function(){
    //Cliente
    Route::post('cliente',[ClienteController::class, 'postCreateUser']);
    Route::get('cliente',[ClienteController::class, 'getAllClientes']);
    //Route::patch('cliente',[ClienteController::class, 'putCliente']);
    Route::delete('cliente/{id}',[ClienteController::class, 'deleteCliente']);

    //usuario
    Route::get('/user-profile', [AuthController::class, 'userProfile']);
    Route::post('/user-profile/{id}/profile-picture', [AuthController::class, 'updateProfilePicture']);
    Route::post('/logout', [AuthController::class, 'logout']);
    Route::post('/refresh', [AuthController::class, 'refresh']);
    
    //medico
    route::post('medico',[MedicoController::class, 'postCreateMedico']);
    route::get('medico',[MedicoController::class, 'getAllMedico']);
    route::put('medico/{id}',[MedicoController::class, 'putUpdateMedico']);
    route::delete('medico/{id}',[MedicoController::class, 'deleteMedico']);
    
    //tipo animal
    route::post('tipoanimal',[TipoAnimalController::class, 'postCreateTipoAnimal']);
    route::get('tipoanimal',[TipoAnimalController::class, 'getAllTipoAnimal']);
    route::put('tipoanimal/{id}',[TipoAnimalController::class, 'putTipoAnimal']);
    route::delete('tipoanimal/{id}',[TipoAnimalController::class, 'deleteTipoAnimal']);
});
    