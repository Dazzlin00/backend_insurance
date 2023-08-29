<?php

use App\Http\Controllers\Api\ProfileController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Api\{LoginController, RegisterController, UserController, PolizaController};
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
  ////SOLO LOS USUARIOS CON EL PERMISO users.list PUEDEN VER LA LISTA DE USUARIOS
  Route::get('users', [UserController::class, 'index'])->middleware(('can:users.list'))->name('users.list');

  //RUTAS PARA LAS POLIZAS

  //SOLO LOS USUARIOS CON EL PERMISO  users.policies PUEDEN VER LAS POLIZAS---------------------------------------------
  Route::get('polizas', [PolizaController::class, 'index'])->middleware(('can:users.policies'))->name('users.policies'); //muestra todos los registros

  //SOLO LOS USUARIOS CON EL PERMISO policies.view PUEDEN ver LAS POLIZAS---------------------------------------------
  Route::get('polizas/{id}', [PolizaController::class, 'show'])->middleware(('can:policies.view'))->name('policies.view'); //ver una poliza

  //SOLO LOS USUARIOS CON EL PERMISO policies.create PUEDEN CREAR LAS POLIZAS---------------------------------------------

  Route::post('polizas', [PolizaController::class, 'store'])->middleware(('can:policies.create'))->name('policies.create'); //crea una poliza

  //SOLO LOS USUARIOS CON EL PERMISO policies.update PUEDEN CREAR LAS POLIZAS---------------------------------------------

  Route::put('polizas/{id}', [PolizaController::class, 'update'])->middleware(('can:policies.update'))->name('policies.update'); //Actualiza una poliza

  //SOLO LOS USUARIOS CON EL PERMISO policies.udpate PUEDEN CREAR LAS POLIZAS---------------------------------------------

  Route::delete('polizas/{id}', [PolizaController::class, 'destroy'])->middleware(('can:policies.delete'))->name('policies.delete'); //Elimina una poliza



});