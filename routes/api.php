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

  //SOLO LOS USUARIOS CON EL PERMISO  users.policies PUEDEN VER LAS POLIZAS---------------------------------------------

  Route::get('polizas', [PolizaController::class, 'index'])->middleware(('can:users.policies'))->name('users.policies');

});