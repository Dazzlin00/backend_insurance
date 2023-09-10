<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Poliza;
use App\Models\Siniestro;
use App\Models\Siniestro_Usuario;
use App\Models\TipoSiniestro;
use App\Models\User;
use Auth;
use Illuminate\Http\Request;

class SiniestroController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //MUESTRA TODOS LOS REGISTROS

        $siniestros = Siniestro::all();

        //OBTENEMOS LA DESCRIPCION DEL TIPO DE SINIESTRO

        foreach ($siniestros as $siniestro) {
            $tipo_siniestro = TipoSiniestro::where('id', $siniestro->id_tipo_siniestro)->first();
            $siniestro->descripcion_tipo_siniestro = $tipo_siniestro->descripcion;
            $cedula = User::where('id', $siniestro->id_usuario)->first();
            $siniestro->numid = $cedula->numid;
            $poliza =Poliza::where('id', $siniestro->id_poliza)->first();
            $siniestro->num_poliza = $poliza->num_poliza;

        }

        return $siniestros;
    }

    public function VerMisSiniestros()
    {
        // Obtenemos el usuario autenticado
        $user = Auth::user();

        // Consultamos la tabla `siniestro_usuario` para obtener los ID de los siniestros del usuario
        $siniestrosIds = Siniestro_Usuario::where('id_usuario', $user->id)->pluck('id_siniestro');

        // Consultamos la tabla `siniestros` para obtener los siniestros del usuario
        $siniestros = Siniestro::whereIn('id', $siniestrosIds)->get();

        // Devolvemos los siniestros
        return $siniestros;
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
        $Siniestro = new Siniestro();
        $Siniestro->id_tipo_siniestro = $request->id_tipo_siniestro;
        $Siniestro->id_poliza = $request->id_poliza;
        $Siniestro->id_usuario = $request->id_usuario;

        $Siniestro->fecha_reporte = $request->fecha_reporte;
        $Siniestro->fecha_declaracion = $request->fecha_declaracion;

        $Siniestro->estado_ocu = $request->estado_ocu;

        $Siniestro->ciudad = $request->ciudad;

        $Siniestro->lugar = $request->lugar;


        $Siniestro->descripcion = $request->descripcion;
        $Siniestro->estado = $request->estado;

        $Siniestro->save();
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $Siniestro = Siniestro::findOrFail($id);
        return $Siniestro;
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
        // Actualiza 
        $Siniestro = Siniestro::findOrFail($id);
        $Siniestro->id_tipo_siniestro = $request->id_tipo_siniestro;
        $Siniestro->numero_siniestro = $request->numero_siniestro;
        $Siniestro->fecha_reporte = $request->fecha_reporte;
        $Siniestro->descripcion = $request->descripcion;
        $Siniestro->estado = $request->estado;

        $Siniestro->save();
        return $Siniestro;
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(Request $request)
    {
        //Elimina
        $Siniestro = Siniestro::destroy($request->id);
        return $Siniestro;
    }
}