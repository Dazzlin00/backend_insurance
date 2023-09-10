<?php

use App\Http\Controllers\Api\CoberturaController;
use App\Http\Controllers\Api\ProfileController;
use App\Http\Controllers\Api\ReclamoController;
use App\Http\Controllers\Api\TipoPolizaController;
use App\Models\Solicitud;
use App\Models\TipoPoliza;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Api\{LoginController, RegisterController, UserController, PolizaController,SiniestroController, Tipo_SiniestroController, MensajeController};
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
Route::post('mensajes', [MensajeController::class, 'store']);


Route::group(['middleware' => ['auth:sanctum']], function () {
  
  Route::get('search', [UserController::class, 'search'])->middleware(('can:users.view'))->name('users.view');

  //MUESTRA LOS DATOS DEL USUARIO AL IGUAL QUE EL LOGIN
  Route::get('userprofile', [LoginController::class, 'userprofile']);
  //CIERRA LA SESION ELIMINANDO EL TOKEN
  Route::post('logout', [LoginController::class, 'logout']);

  //RUTAS PARA USUARIOS

  Route::get('users', [UserController::class, 'index'])->middleware(('can:users.list'))->name('users.list');
  //Route::get('users/{id}', [UserController::class, 'show'])->middleware(('can:users.view'))->name('users.view'); //ver
  Route::post('users', [UserController::class, 'store'])->middleware(('can:users.create'))->name('users.create'); //crea 
  Route::put('users/{id}', [UserController::class, 'update'])->middleware(('can:users.update'))->name('users.update'); //Actualiza 
  Route::delete('users/{id}', [UserController::class, 'destroy'])->middleware(('can:users.delete'))->name('users.delete'); //Elimina 

  //RUTAS PARA LAS POLIZAS
  Route::get('polizas', [PolizaController::class, 'index'])->middleware(('can:users.policies'))->name('users.policies'); //muestra todos los registros
  Route::get('polizas/{id}', [PolizaController::class, 'show'])->middleware(('can:policies.view'))->name('policies.view'); //ver una poliza
  Route::post('polizas', [PolizaController::class, 'store'])->middleware(('can:policies.create'))->name('policies.create'); //crea una poliza
  Route::put('polizas/{id}', [PolizaController::class, 'update'])->middleware(('can:policies.update'))->name('policies.update'); //Actualiza una poliza
  Route::delete('polizas/{id}', [PolizaController::class, 'destroy'])->middleware(('can:policies.delete'))->name('policies.delete'); //Elimina una poliza
  Route::get('tipopolizas', [TipoPolizaController::class, 'index'])->middleware(('can:policies.view'))->name('policies.view'); 

  //RUTA QUE MUESTRA LAS POLIZAS DEL USUARIO
  Route::get('user-poliza', [PolizaController::class, 'VerMisPolizas'])->middleware(('can:users.policies.me'))->name('users.policies.me'); //muestra todos mis registros
  Route::get('user-poliza/{id}', [PolizaController::class, 'VerMiPoliza'])->middleware(('can:users.policies.me'))->name('users.policies.me');

  //RUTAS PARA LOS SINIESTROS
  Route::get('siniestros', [SiniestroController::class, 'index'])->middleware(('can:sinister.list'))->name('sinister.list'); //muestra todos los registros
  Route::get('siniestros/{id}', [SiniestroController::class, 'show'])->middleware(('can:sinister.view'))->name('sinister.view'); //ver 
  Route::post('siniestros', [SiniestroController::class, 'store'])->middleware(('can:sinister.create'))->name('sinister.create'); //crea 
  Route::put('siniestros/{id}', [SiniestroController::class, 'update'])->middleware(('can:sinister.update'))->name('sinister.update'); //Actualiza 
  Route::delete('siniestros/{id}', [SiniestroController::class, 'destroy'])->middleware(('can:sinister.delete'))->name('sinister.delete'); //Elimina 
  Route::get('siniestro', [SiniestroController::class, 'VerMisSiniestros'])->middleware(('can:sinister.me'))->name('sinister.me'); //muestra todos los registros

  //RUTAS PARA TIPOS DE SINIESTROS
  Route::get('tipos-siniestros', [Tipo_SiniestroController::class, 'index'])->middleware(('can:sinister.list'))->name('sinister.list');
  Route::get('tipos-siniestros/{id}', [Tipo_SiniestroController::class, 'show'])->middleware(('can:sinister.view'))->name('sinister.view');
  Route::post('tipos-siniestros', [Tipo_SiniestroController::class, 'store'])->middleware(('can:sinister.create'))->name('sinister.create');
  Route::put('tipos-siniestros/{id}', [Tipo_SiniestroController::class, 'update'])->middleware(('can:sinister.update'))->name('sinister.update');
  Route::delete('tipos-siniestros/{id}', [Tipo_SiniestroController::class, 'destroy'])->middleware(('can:sinister.delete'))->name('sinister.delete');
  //RUTAS PARA TIPOS DE SINIESTROS

  //RUTAS DE MENSAJES
  Route::get('mensajes', [MensajeController::class, 'index'])->middleware(('can:clains.list'))->name('clains.list');
  Route::get('mensajes/{id}', [MensajeController::class, 'show'])->middleware(('can:clains.view'))->name('clains.view');
  Route::put('mensajes/{id}', [MensajeController::class, 'update'])->middleware(('can:clains.update'))->name('clains.update');
  Route::delete('mensajes/{id}', [MensajeController::class, 'destroy'])->middleware(('can:clains.delete'))->name('clains.delete');
  //RUTAS DE MENSAJES

  //RUTAS -- !!!ADMIN!!!

  //USUARIOS
  //Route::get('users', [UserController::class, 'index'])->middleware(('can:users.list'))->name('users.list');
  Route::get('users/{id}', [UserController::class, 'show'])->middleware(('can:users.view'))->name('users.view');
  Route::post('users', [UserController::class, 'store'])->middleware(('can:users.create'))->name('users.create');
  Route::put('users/{id}', [UserController::class, 'update'])->middleware(('can:users.update'))->name('users.update');
  Route::delete('users/{id}', [UserController::class, 'destroy'])->middleware(('can:users.delete'))->name('users.delete');
  //USUARIOS

  //PERMISOS
  Route::get('permissions', [Tipo_Siniestro::class, 'index'])->middleware(('can:users.permissions'))->name('users.permissions');
  Route::get('permissions/{id}', [Tipo_Siniestro::class, 'show'])->middleware(('can:permissions.view'))->name('permissions.view');
  Route::put('permissions/{user_id}', [Tipo_Siniestro::class, 'update'])->middleware(('can:permissions.update'))->name('permissions.update');
  //PERMISOS

  //RUTAS -- !!!ADMIN!!!

  //RUTAS PARA LAS COBERTURAS
  Route::get('coberturas', [CoberturaController::class, 'index'])->middleware(('can:coverage.list'))->name('coverage.list');
  Route::get('coberturas/{id}', [CoberturaController::class, 'show'])->middleware(('can:coverage.view'))->name('coverage.view');
  Route::post('coberturas', [CoberturaController::class, 'store'])->middleware(('can:coverage.create'))->name('coverage.create');
  Route::put('coberturas/{id}', [CoberturaController::class, 'update'])->middleware(('can:coverage.update'))->name('coverage.update');
  Route::delete('coberturas/{id}', [CoberturaController::class, 'destroy'])->middleware(('can:coverage.delete'))->name('coverage.delete');
  //RUTAS PARA RECLAMOS
  Route::get('reclamos', [ReclamoController::class, 'index'])->middleware(('can:clains.list'))->name('clains.list');
  Route::get('reclamos/{id}', [ReclamoController::class, 'show'])->middleware(('can:clains.view'))->name('clains.view');
  Route::post('reclamos', [ReclamoController::class, 'store'])->middleware(('can:clains.create'))->name('clains.create');
  Route::put('reclamos/{id}', [ReclamoController::class, 'update'])->middleware(('can:clains.update'))->name('clains.update');
  Route::delete('reclamos/{id}', [ReclamoController::class, 'destroy'])->middleware(('can:clains.delete'))->name('clains.delete');
  Route::get('reclamos', [ReclamoController::class, 'VerMisReclamos'])->middleware(('can:clains.me'))->name('clains.me'); //muestra los reclamos del usuario

});