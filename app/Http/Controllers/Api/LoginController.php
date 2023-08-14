<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Requests\LoginRequest;
use App\Http\Helpers\Helper;
use App\Http\Resources\UserResource;
use Auth;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Cookie;


class LoginController extends Controller
{
    public function login(LoginRequest $request)
    {
        if (!Auth::attempt($request->only('email', 'password'))) {
            Helper::sendError('Email o Contraseña incorrectos');
        }

       Helper::sendSuccess('Bienvenido');
    
    }
    public function userprofile(Request $request)
    {
        //Muestra los datos de usuario
        return new UserResource(auth()->user());
        
    }
    function getusername(Request $request) {
      return $request->user();
      }
    public function logout(Request $request)
{
    // Revoca todos los tokens del usuario
   $request->user()->tokens()->delete();

    // Elimina la cookie del token
    $cookie = Cookie::forget('token');

    return response()->json(['message' => 'Sesión cerrada exitosamente'])->withCookie($cookie);
}
}