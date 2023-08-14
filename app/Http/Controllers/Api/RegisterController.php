<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Requests\RegisterRequest;
use App\Http\Helpers\Helper;
use App\Http\Resources\UserResource;
use App\Models\User;
use Spatie\Permission\Models\Role;

class RegisterController extends Controller
{
    public function register(RegisterRequest $request)
    {
        //registrar usuario
        $user = User::create([
            'name' => $request->name,
            'email' => $request->email,
            'password' => bcrypt($request->password)
        ]);
//Asignar rol

  $user_role= Role::where(['name' => 'user'])->first();

  if($user_role){
    $user->assignRole($user_role);
  }
       
        //envia respuesta
        return new UserResource($user);

    }



}