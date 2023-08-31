<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Siniestro;
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

       $Siniestro = Siniestro::all();
       return $Siniestro;
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
        $Siniestro= new Siniestro();
        $Siniestro->id_tipo_siniestro= $request->id_tipo_siniestro;
        $Siniestro->numero_siniestro= $request->numero_siniestro;
        $Siniestro->fecha_reporte= $request->fecha_reporte;
        $Siniestro->descripcion= $request->descripcion;
        $Siniestro->estado= $request->estado;

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
        $Siniestro= Siniestro::findOrFail($id);
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
        $Siniestro= Siniestro::findOrFail($id);
        $Siniestro->id_tipo_siniestro= $request->id_tipo_siniestro;
        $Siniestro->numero_siniestro= $request->numero_siniestro;
        $Siniestro->fecha_reporte= $request->fecha_reporte;
        $Siniestro->descripcion= $request->descripcion;
        $Siniestro->estado= $request->estado;

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
         $Siniestro= Siniestro::destroy($request->id);
         return $Siniestro;
    }
}
