<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Cobertura_siniestro;
use App\Models\Cobertura_tipo_Siniestro;
use App\Models\Poliza;
use App\Models\Siniestro;
use App\Models\Siniestro_Usuario;
use App\Models\TipoSiniestro;
use App\Models\User;
use Auth;
use DB;
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
            $poliza = Poliza::where('id', $siniestro->id_poliza)->first();
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
    public function VerSiniestro($id)
    {

        $siniestro = Siniestro::where('siniestros.id', $id)
            ->join('users', 'siniestros.id_usuario', '=', 'users.id')
            ->join('polizas', 'siniestros.id_poliza', '=', 'polizas.id')
            ->join('tipo_siniestros', 'siniestros.id_tipo_siniestro', '=', 'tipo_siniestros.id')
            ->select('users.numid', 'users.name', 'polizas.num_poliza', 'tipo_siniestros.descripcion as tiposiniestrodes', 'siniestros.*')
            ->first();

        return $siniestro;


    }
    /* public function VerTipoSiniestroPorCobertura($descripcion)
     {
         

         $tipoSiniestro = Cobertura_siniestro::where('coberturas.descripcion', $descripcion)
             ->join('tipo_siniestros', 'cobertura_siniestros.id_tipo_siniestro', '=', 'tipo_siniestros.id')
             ->join('coberturas', 'cobertura_siniestros.id_cobertura', '=', 'coberturas.id')
             ->select('tipo_siniestros.descripcion')
             ->first();

         return $tipoSiniestro;


     }*/

    public function VerTipoSiniestroPorPoliza($Poliza)
    {
        /*return DB::table('tipo_siniestros')
            ->join('cobertura_siniestros', 'tipo_siniestros.id', '=', 'cobertura_siniestros.id_tipo_siniestro')
            ->join('coberturas', 'cobertura_siniestros.id_cobertura', '=', 'coberturas.id')
            ->join('polizas', 'coberturas.id', '=', 'polizas.cobertura')

            ->where('polizas.num_poliza', '=', $Poliza)
            ->select('tipo_siniestros.descripcion','tipo_siniestros.id as id_tsiniestro')
            ->get();*/

        return DB::table('tipo_siniestros')
            ->join('cobertura_siniestros', 'tipo_siniestros.id', '=', 'cobertura_siniestros.id_tipo_siniestro')
            ->join('coberturas', 'cobertura_siniestros.id_cobertura', '=', 'coberturas.id')
            ->join('polizas', 'coberturas.id', '=', 'polizas.cobertura')

            ->where('polizas.id', '=', $Poliza)
            ->select('tipo_siniestros.descripcion', 'tipo_siniestros.id as id_tsiniestro')
            ->get();
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
        $Siniestro->estado = "Activa";

        $Siniestro->save();

        $Siniestro->usuarios()->attach($request->id_usuario);

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
        // $Siniestro->id_tipo_siniestro = $request->id_tipo_siniestro;
        // $Siniestro->numero_siniestro = $request->numero_siniestro;
        $Siniestro->fecha_reporte = $request->fecha_reporte;
        $Siniestro->fecha_declaracion = $request->fecha_declaracion;
        $Siniestro->estado_ocu = $request->estado_ocu;
        $Siniestro->ciudad = $request->ciudad;
        $Siniestro->lugar = $request->lugar;
        $Siniestro->descripcion = $request->descripcion;
        // $Siniestro->estado = $request->estado;

        $Siniestro->save();
        return $Siniestro;
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */


    public function destroy(Request $request, $id)
    {
        //Elimina
        $Siniestro = Siniestro::find($id);
        $Siniestro->usuarios()->detach();
        $Siniestro->delete();

        //  $Siniestro = Siniestro::destroy($request->id);

        //return $Siniestro;
    }
}