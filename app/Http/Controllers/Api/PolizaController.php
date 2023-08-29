<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Poliza;

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

        $poliza = Poliza::all();
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
        $poliza= new Poliza();
        $poliza->id_usuario= $request->id_usuario;
        $poliza->num_poliza= $request->num_poliza;
        $poliza->fecha_inicio= $request->fecha_inicio;
        $poliza->fecha_vencimiento= $request->fecha_vencimiento;
        $poliza->monto_prima= $request->monto_prima;

        $poliza->estado= $request->estado;

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
        
            $poliza= Poliza::findOrFail($id);
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
        $poliza= Poliza::findOrFail($id);
        $poliza->id_usuario= $request->id_usuario;
        $poliza->num_poliza= $request->num_poliza;
        $poliza->fecha_inicio= $request->fecha_inicio;
        $poliza->fecha_vencimiento= $request->fecha_vencimiento;
        $poliza->estado= $request->estado;
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
        $poliza= Poliza::destroy($request->id);
        return $poliza;
    }
}