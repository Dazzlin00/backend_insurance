<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Cobertura;
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

    //OBTENEMOS EL NOMBRE DEL USUARIO

    foreach ($polizas as $poliza) {
        $usuario = User::where('id', $poliza->id_usuario)->first();
        $poliza->name = $usuario->name;
    }

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
        $periodo = Carbon::parse($request->fecha_inicio)->diffInDays($request->fecha_vencimiento);



        $tasa_base = $request->cobertura * 1;
        $poliza = new Poliza();
        $poliza->id_usuario = $request->id_usuario;

        $cantidad_digitos = 10;
        $poliza->num_poliza = random_int(pow(10, $cantidad_digitos - 1), pow(10, $cantidad_digitos) - 1);

        $poliza->tipo_poliza = $request->tipo_poliza;
        $poliza->fecha_inicio = $request->fecha_inicio;
        $poliza->fecha_vencimiento = $request->fecha_vencimiento;
        $poliza->cobertura = $request->cobertura;
        $poliza->monto_prima = $poliza->cobertura * $periodo * $tasa_base;

        $poliza->estado = 'Activa';

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

        $poliza = Poliza::findOrFail($id);
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
        $poliza->id_usuario = $request->id_usuario;
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