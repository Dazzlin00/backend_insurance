<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\TipoSiniestro;
use Illuminate\Http\Request;

class Tipo_SiniestroController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $tipo_siniestro = TipoSiniestro::all();
        return $tipo_siniestro;
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
    public function store( Request $request)
    {
        $tipo_siniestro = new TipoSiniestro();
        $tipo_siniestro->descripcion = $request->descripcion;

        $tipo_siniestro->save();

    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $tipo_siniestro = TipoSiniestro::findOrFail($id);
        return $tipo_siniestro;
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
    public function update( Request $request, $id)
    {
        $tipo_siniestro = TipoSiniestro::findOrFail($id);
        $tipo_siniestro->descripcion = $request->descripcion;

        $tipo_siniestro->save();
        return $tipo_siniestro;
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy( Request $request )
    {
        $tipo_siniestro = TipoSiniestro::destroy($request->id);
        return $tipo_siniestro;
    }
}
