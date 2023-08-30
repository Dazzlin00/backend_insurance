<?php

use App\Http\Controllers\Api\ProfileController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Api\{LoginController, RegisterController, UserController, PolizaController, Tipo_SiniestroController};
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

  //RUTAS PARA TIPOS DE SINIESTROS
  Route::get('tipos-siniestros', [Tipo_SiniestroController::class, 'index'])->middleware(('can:sinister.list'))->name('sinister.list');
  Route::get('tipos-siniestros/{id}', [Tipo_SiniestroController::class, 'show'])->middleware(('can:sinister.view'))->name('sinister.view');
  Route::post('tipos-siniestros', [Tipo_SiniestroController::class, 'store'])->middleware(('can:sinister.create'))->name('sinister.create');
  Route::put('tipos-siniestros/{id}', [Tipo_SiniestroController::class, 'update'])->middleware(('can:sinister.update'))->name('sinister.update');
  Route::delete('tipos-siniestros/{id}', [Tipo_SiniestroController::class, 'destroy'])->middleware(('can:sinister.delete'))->name('sinister.delete');
  //RUTAS PARA TIPOS DE SINIESTROS

  //RUTAS PARA PERMISOS !!!ADMIN!!!
  Route::get('permissions', [Tipo_Siniestro::class, 'index'])->middleware(('can:users.permissions'))->name('users.permissions');
  Route::get('permissions/{id}', [Tipo_Siniestro::class, 'show'])->middleware(('can:permissions.view'))->name('permissions.view');
  Route::put('permissions/{user_id}', [Tipo_Siniestro::class, 'update'])->middleware(('can:permissions.update'))->name('permissions.update');
  //RUTAS PARA PERMISOS !!!ADMIN!!!

});