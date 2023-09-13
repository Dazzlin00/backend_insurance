<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Cobertura;
use App\Models\TipoPoliza;
use Carbon\Carbon;
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
        ->select('polizas.num_poliza','polizas.id as id_poliza','Coberturas.id as id_cobertura','Coberturas.descripcion as desc_cobertura' , 'users.name as nombre','users.id as id_usuario')
        ->join('coberturas', 'polizas.cobertura', '=', 'coberturas.id')
        ->join('users', 'polizas.id_usuario', '=', 'users.id')
        ->get();

    return $polizas;
}

    public function VerMisPolizas()
    {
        //$poliza = Poliza::where('id_usuario', auth()->user()->id)->get();
        //return $poliza;

        $poliza = Poliza::join('tipo_polizas', 'tipo_polizas.id', '=', 'polizas.tipo_poliza')
            ->where('id_usuario', auth()->user()->id)
            ->get();
        return $poliza;
    }

    public function VerMiPoliza($id)
    {

        $poliza = Poliza::join('tipo_polizas', 'tipo_polizas.id', '=', 'polizas.tipo_poliza')
            ->join('coberturas', 'coberturas.id','=','polizas.cobertura')
            ->join('users', 'users.id','=','polizas.id_usuario')
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

        $poliza->id_usuario =$request->id_usuario;

        $poliza->num_poliza = $request->num_poliza;

        $poliza->tipo_poliza = $request->tipo_poliza;
        $poliza->fecha_inicio = $request->fecha_inicio;
        $poliza->fecha_vencimiento = $request->fecha_vencimiento;
        $poliza->cobertura = $request->cobertura;
        $poliza->monto_prima = $request->monto_prima;
       $poliza->estado = $request->estado;
       // $poliza->estado="A" ;

        $poliza->save();

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
            ->join('coberturas', 'coberturas.id','=','polizas.cobertura')
            ->join('tipo_polizas', 'tipo_polizas.id', '=', 'polizas.tipo_poliza')
            ->findOrFail($id, ['polizas.*', 'users.numid as numid', 'users.name as username','coberturas.monto_cobertura as cobertura','tipo_polizas.descripcion as tipo_poliza']);

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
        $poliza->num_poliza = $request->num_poliza;
        $poliza->fecha_inicio = $request->fecha_inicio;
        $poliza->fecha_vencimiento = $request->fecha_vencimiento;
        $poliza->estado = $request->estado;
        $poliza->save();
        return $poliza;
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(Request $request)
    {
        //Elimina una poliza
        $poliza = Poliza::destroy($request->id);
        return $poliza;
    }
}