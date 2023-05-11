<?php

use App\Http\Controllers\AnimalController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\CitaController;
use App\Http\Controllers\ClienteController;
use App\Http\Controllers\DetalleConsultaController;
use App\Http\Controllers\MedicoController;
use App\Http\Controllers\ServicioController;
use App\Http\Controllers\TipoAnimalController;


Route::group([
    'middleware' => 'api',
    'prefix' => 'auth'
], function ($router) {
    Route::post('/login', [AuthController::class, 'login']);
    Route::post('/register', [AuthController::class, 'register']);
});

Route::group(['middleware' => ['jwt.verify','upload']], function(){
    //Rutas : usuario
    Route::get('/user-profile', [AuthController::class, 'userProfile']);
    Route::post('/user-profile/{id}/profile-picture', [AuthController::class, 'updateProfilePicture']);
    Route::post('/logout', [AuthController::class, 'logout']);
    Route::post('/refresh', [AuthController::class, 'refresh']);

    //Rutas : Cliente
    Route::post('cliente',[ClienteController::class, 'postCreateUser']);
    Route::get('cliente/{id}',[ClienteController::class, 'show']);
    Route::get('cliente',[ClienteController::class, 'getAllClientes']);
    Route::patch('cliente/{id}',[ClienteController::class, 'putcliente']);
    Route::delete('cliente/{id}',[ClienteController::class, 'deleteCliente']);    
    
    //Rutas : medico
    route::post('medico',[MedicoController::class, 'postCreateMedico']);//Crea un nuevo registro
    route::get('medico',[MedicoController::class, 'getAllMedico']);//consulta todos los registros
    route::get('medico/{id}',[MedicoController::class, 'show']);//Consulta un registro mediante el id
    route::patch('medico/{id}',[MedicoController::class, 'putUpdateMedico']);//Actualiza el registro especificado en el id
    route::delete('medico/{id}',[MedicoController::class, 'deleteMedico']);//Elimina un registro mediante el id
    
    // Rutas : tipo animal
    route::post('tipoanimal',[TipoAnimalController::class, 'postCreateTipoAnimal']);//Crea un nuevo registro
    route::get('tipoanimal/{id}',[TipoAnimalController::class, 'show']); //consulta por id
    route::get('tipoanimal',[TipoAnimalController::class, 'getAllTipoAnimal']); //consulta todos los id
    route::patch('tipoanimal/{id}',[TipoAnimalController::class, 'putTipoAnimal']);//Actualiza el registro especificado en el id
    route::delete('tipoanimal/{id}',[TipoAnimalController::class, 'deleteTipoAnimal']);//Elimina un registro mediante el id
    
    // Rutas : Animal
    route::post('animal',[AnimalController::class, 'postCreateAnimal']); //Crea un nuevo registro
    route::get('animal/{id}',[AnimalController::class, 'show']);
    route::get('animal',[AnimalController::class, 'getAllAnimal']); //consulta todos los registros
    route::patch('animal/{id}',[AnimalController::class, 'putAnimal']); //Actualiza el registro especificado en el id
    route::delete('animal/{id}',[AnimalController::class, 'deleteAnimal']);//Elimina un registro mediante el id
    
    //Servicio
    Route::post('servicio',[ServicioController::class, 'createservicio']);//Crea un nuevo registro
    Route::get('servicio/{id}',[ServicioController::class, 'show']);//consulta un registro
    Route::get('servicio',[ServicioController::class, 'getAllServicio']);//consulta todos los registros
    Route::patch('actualizarservicio/{id}',[ServicioController::class, 'update']);//Actualiza el registro especificado en el id
    Route::delete('servicio/{id}',[ServicioController::class, 'destroy']);//Elimina un registro mediante el id
    //Cita
    Route::post('cita',[CitaController::class, 'store']);//Crea un nuevo registro
    Route::get('cita/{id}',[CitaController::class, 'show']);//consulta un registro
    Route::get('cita',[CitaController::class, 'index']);//consulta todos los registros
    Route::patch('cita/{id}',[CitaController::class, 'update']);//Actualiza el registro especificado en el id
    Route::delete('cita/{id}',[CitaController::class, 'destroy']);//Elimina un registro mediante el id
    
    //Detalle Consulta
    Route::post('detalle',[DetalleConsultaController::class, 'store']);//Crea un nuevo registro
    Route::get('detalle/{id}',[DetalleConsultaController::class, 'show']);//consulta un registro
    Route::get('detalle',[DetalleConsultaController::class, 'index']);//consulta todos los registros
    Route::patch('detalle/{id}',[DetalleConsultaController::class, 'update']);//Actualiza el registro especificado en el id
    Route::delete('detalle/{id}',[DetalleConsultaController::class, 'destroy']);//Elimina un registro mediante el id
});