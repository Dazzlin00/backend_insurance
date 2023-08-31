<?php

use App\Http\Controllers\Api\ProfileController;
use App\Models\Solicitud;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Api\{LoginController, RegisterController, UserController, PolizaController, SiniestroController, SolicitudController};
use App\Http\Resources\UserResource;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/

//INICIO Y REGITRO DE USUARIOS
Route::post('login', [LoginController::class, 'login']);
Route::post('register', [RegisterController::class, 'register']);


Route::group(['middleware' => ['auth:sanctum']], function () {
  //MUESTRA LOS DATOS DEL USUARIO AL IGUAL QUE EL LOGIN
  Route::get('userprofile', [LoginController::class, 'userprofile']);
  //CIERRA LA SESION ELIMINANDO EL TOKEN
  Route::post('logout', [LoginController::class, 'logout']);

  //RUTAS PARA USUARIOS

  Route::get('users', [UserController::class, 'index'])->middleware(('can:users.list'))->name('users.list');
  Route::get('users/{id}', [UserController::class, 'show'])->middleware(('can:users.view'))->name('users.view'); //ver
  Route::post('users', [UserController::class, 'store'])->middleware(('can:users.create'))->name('users.create'); //crea 
  Route::put('users/{id}', [UserController::class, 'update'])->middleware(('can:users.update'))->name('users.update'); //Actualiza 
  Route::delete('users/{id}', [UserController::class, 'destroy'])->middleware(('can:users.delete'))->name('users.delete'); //Elimina 

  //RUTAS PARA LAS POLIZAS
  Route::get('polizas', [PolizaController::class, 'index'])->middleware(('can:users.policies'))->name('users.policies'); //muestra todos los registros
  Route::get('polizas/{id}', [PolizaController::class, 'show'])->middleware(('can:policies.view'))->name('policies.view'); //ver una poliza
  Route::post('polizas', [PolizaController::class, 'store'])->middleware(('can:policies.create'))->name('policies.create'); //crea una poliza
  Route::put('polizas/{id}', [PolizaController::class, 'update'])->middleware(('can:policies.update'))->name('policies.update'); //Actualiza una poliza
  Route::delete('polizas/{id}', [PolizaController::class, 'destroy'])->middleware(('can:policies.delete'))->name('policies.delete'); //Elimina una poliza

  

  //RUTAS PARA LOS SINIESTROS
  Route::get('siniestros', [SiniestroController::class, 'index'])->middleware(('can:sinister.list'))->name('sinister.list'); //muestra todos los registros
  Route::get('siniestros/{id}', [SiniestroController::class, 'show'])->middleware(('can:sinister.view'))->name('sinister.view'); //ver 
  Route::post('siniestros', [SiniestroController::class, 'store'])->middleware(('can:sinister.create'))->name('sinister.create'); //crea 
  Route::put('siniestros/{id}', [SiniestroController::class, 'update'])->middleware(('can:sinister.update'))->name('sinister.update'); //Actualiza 
  Route::delete('siniestros/{id}', [SiniestroController::class, 'destroy'])->middleware(('can:sinister.delete'))->name('sinister.delete'); //Elimina 



});