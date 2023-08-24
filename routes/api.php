<?php

use App\Http\Controllers\Api\ProfileController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Api\{LoginController, RegisterController,UserController};
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


Route::post('login', [LoginController::class, 'login']);
Route::post('register', [RegisterController::class, 'register']);


Route::group(['middleware' => ['auth:sanctum']], function () {
    Route::get('userprofile', [LoginController::class, 'userprofile']);
   
    
   
    Route::get('/user', function (Request $request) {
        return $request->user();
    });
      Route::get('users', [AdminController::class, 'index']);

    Route::post('logout', [LoginController::class, 'logout']);
    //MUESTRA LA LISTA DE USUARIOS
    Route::get('users', [UserController::class, 'index'])->middleware(('can:users.list'))->name('users.list');

}); 



