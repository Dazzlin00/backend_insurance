<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Cobertura;
use App\Models\Poliza_Usuario;
use App\Models\TipoPoliza;
use Auth;
use Carbon\Carbon;
use DB;
use Illuminate\Http\Request;
use App\Models\Poliza;
use App\Models\User;

class PolizaController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //MUESTRA TODAS LAS POLIZAS

        $polizas = Poliza::all();

        //OBTENEMOS LA DESCRIPCION DE TIPO POLIZA

        foreach ($polizas as $poliza) {
            $tipoPoliza = TipoPoliza::where('id', $poliza->tipo_poliza)->first();
            $poliza->descripcion = $tipoPoliza->descripcion;
            $cobertura = Cobertura::where('id', $poliza->cobertura)->first();
            $poliza->descripcion_cobertura = $cobertura->descripcion;
            $usuario = User::where('id', $poliza->id_usuario)->first();
            $poliza->name = $usuario->name;
        }

        return $polizas;
    }
    public function getPolizas(Request $request)
    {
        $numid = $request->input('numid');

        $polizas = Poliza::where('id_usuario', User::where('numid', $numid)->first()->id)
            ->select('polizas.num_poliza', 'polizas.id as id_poliza', 'Coberturas.id as id_cobertura', 'Coberturas.descripcion as desc_cobertura', 'users.name as nombre', 'users.id as id_usuario')
            ->join('coberturas', 'polizas.cobertura', '=', 'coberturas.id')
            ->join('users', 'polizas.id_usuario', '=', 'users.id')
            ->get();

        return $polizas;
    }

    public function VerMisPolizas()
    {



        /*  // Obtenemos el usuario autenticado
          $user = Auth::user();

          // Consultamos la tabla `siniestro_usuario` para obtener los ID de los siniestros del usuario
          $polizaid = Poliza_Usuario::where('id_usuario', $user->id)->pluck('id_poliza');

          // Consultamos la tabla `siniestros` para obtener los siniestros del usuario
          $poliza = Poliza::whereIn('id', $polizaid)->get();

          // Devolvemos los siniestros
          return $poliza;*/

        // Obtenemos el usuario autenticado
        $user = Auth::user();

        // Consultamos la tabla `siniestro_usuario` para obtener los ID de los siniestros del usuario
        $polizaid = Poliza_Usuario::where('id_usuario', $user->id)->pluck('id_poliza');

        // Consultamos la tabla `siniestros` para obtener los siniestros del usuario
        $poliza = Poliza::whereIn('id', $polizaid)->get();

        // Obtenemos la descripción del tipo de póliza para cada siniestro
        $poliza->each(function ($poliza) {
            $poliza->tipo_poliza = TipoPoliza::find($poliza->tipo_poliza)->descripcion;
        });

        // Devolvemos los siniestros
        return $poliza;

    }

    public function VerMiPoliza($id)
    {

        $poliza = Poliza::join('tipo_polizas', 'tipo_polizas.id', '=', 'polizas.tipo_poliza')
            ->join('coberturas', 'coberturas.id', '=', 'polizas.cobertura')
            ->join('users', 'users.id', '=', 'polizas.id_usuario')
            ->where('polizas.id_usuario', auth()->user()->id)
            ->where('polizas.id', $id)
            ->select('polizas.*', 'coberturas.monto_cobertura as cobertura', 'tipo_polizas.descripcion as tipo_poliza', 'users.numid as numid', 'users.name as username')
            ->first();
        return $poliza;
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


    public function VerCoberturaPorTipoPoliza($tipo_poliza)
    {


        // Obtenemos los datos de la tabla de coberturas
        $coberturas = DB::table('coberturas')
            ->select(['coberturas.descripcion AS coberturas', 'coberturas.id AS id_cobertura', 'coberturas.monto_cobertura AS monto_cobertura', 'tipo_polizas.descripcion AS tipo_poliza'])
            ->join('tipo_poliza__coberturas', 'coberturas.id', '=', 'tipo_poliza__coberturas.id_cobertura')
            ->join('tipo_polizas', 'tipo_poliza__coberturas.id_tipo_poliza', '=', 'tipo_polizas.id')
            ->where('tipo_polizas.id', $tipo_poliza)
            ->get();

        // Devolvemos los resultados
        return $coberturas;
    }

    public function VerMonto_Cobertura($tipo_poliza)
    {


        $cobertura = Cobertura::find($tipo_poliza);
        if ($cobertura) {
            return $cobertura->monto_cobertura;
        }
        return null;
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        // Obtener el período de cobertura
        // $periodo = Carbon::parse($request->fecha_inicio)->diffInDays($request->fecha_vencimiento);

        //$tasa_base = $request->cobertura * 1;
        $poliza = new Poliza();

        $poliza->id_usuario = $request->id_usuario;

        $poliza->num_poliza = $request->num_poliza;

        $poliza->tipo_poliza = $request->tipo_poliza;
        $poliza->fecha_inicio = $request->fecha_inicio;
        $poliza->fecha_vencimiento = $request->fecha_vencimiento;
        $poliza->cobertura = $request->cobertura;
        $poliza->monto_prima = $request->monto_prima;
        // $poliza->estado = $request->estado;
        $poliza->estado = "Activa";

        $poliza->save();
        // $poliza->coberturas()->attach($request->id_cobertura);
        $poliza->usuarios()->attach($request->id_usuario);

    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {

        $poliza = Poliza::join('users', 'users.id', '=', 'polizas.id_usuario')
            ->join('coberturas', 'coberturas.id', '=', 'polizas.cobertura')
            ->join('tipo_polizas', 'tipo_polizas.id', '=', 'polizas.tipo_poliza')
            ->findOrFail($id, ['polizas.*', 'users.numid as numid', 'users.name as username', 'coberturas.monto_cobertura as monto_cobertura', 'coberturas.descripcion as cobertura', 'tipo_polizas.descripcion as tipo_poliza']);

        //$poliza = Poliza::findOrFail($id);
        return $poliza;

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
        // Actualiza la poliza
        $poliza = Poliza::findOrFail($id);
        //$poliza->id_usuario = $request->id_usuario;
        //$poliza->num_poliza = $request->num_poliza;
        $poliza->fecha_inicio = $request->fecha_inicio;
        $poliza->fecha_vencimiento = $request->fecha_vencimiento;

        //$poliza->estado = $request->estado;
        $poliza->save();
        return $poliza;
    }

    public function Aprobar(Request $request, $id)
    {
        // Actualiza 
        $poliza = Poliza::findOrFail($id);
        $poliza->estado = "Aprobada";

        $poliza->save();
        return $poliza;
    }
    public function Rechazar(Request $request, $id)
    {
        // Actualiza 
        $poliza = Poliza::findOrFail($id);
        $poliza->estado = "Rechazada";

        $poliza->save();
        return $poliza;
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
        $poliza = Poliza::find($id);
        $poliza->usuarios()->detach();
        $poliza->delete();
    }
}