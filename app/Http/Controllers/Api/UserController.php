<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
//use Illuminate\Foundation\Auth\User;
use App\Models\Poliza;
use Illuminate\Http\Request;
use Illuminate\Support\Carbon;
use Illuminate\Support\Facades\Auth;
use Spatie\Permission\Models\Role;
use App\Models\User;

use Spatie\QueryBuilder\QueryBuilder;

class UserController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {

        $usuarios = User::all();

        foreach ($usuarios as $usuario) {
            $usuario->roles->first();
        }
        
        return $usuarios;
    }
    public function search(Request $request)
    {
        $numid = $request->input('numid');

        $user = User::where('numid', '=', $numid)->first();

        if ($user) {
            return response()->json($user);
        } else {
            return response()->json(['error' => 'No se encontró el usuario'], 404);
        }
    }
    public function SearchUserPoliza(Request $request)
    {
       
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {

        $user = User::create([
            'name' => $request->name,
            'numid' => $request->numid,
            'address' => $request->address,
            'phone' => $request->phone,
            'email' => $request->email,
            'password' => bcrypt($request->password),
            'registro' => Carbon::now()->format('Y-m-d'),
        ]);

        if ($request->role)
            $user_role = Role::where(['name' => $request->role])->first();

        if ($user_role) {
            $user->assignRole($user_role);
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $user = User::findOrFail($id);
        $user->roles->first();
        return $user;
    }

    public function getRolesName()
    {
        return Role::whereNotIn('name', ['admin'])->pluck('name');
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $user = User::findOrFail($id);
        $user->name = $request->name;
        $user->numid = $request->numid;
        $user->address = $request->address;
        $user->phone = $request->phone;
        $user->email = $request->email;

        if ($request->role)
            $user_role = Role::where(['name' => $request->role])->first();

        if ($user_role) {
            $user->assignRole($user_role);
        }

        //$user->password = $request->password;

        $user->save();

        return $user;
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(Request $request)
    {
        $user = User::destroy($request->id);
        return $user;
    }
}