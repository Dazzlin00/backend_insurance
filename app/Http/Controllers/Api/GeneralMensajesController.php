<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\GeneralMensajes;
use Illuminate\Http\Request;

class GeneralMensajesController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //MUESTRA TODOS LOS REGISTROS

        $GeneralMensajes = GeneralMensajes::all();
        return $GeneralMensajes;
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
        $GeneralMensajes = new GeneralMensajes();
        $GeneralMensajes->email = $request->email;
        $GeneralMensajes->contenido = $request->contenido;
        $GeneralMensajes->setEstadoAttribute('No Contestado');
        $GeneralMensajes->id_agente = $request->id_agente;

        $GeneralMensajes->save();
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $GeneralMensajes = GeneralMensajes::findOrFail($id);
        $GeneralMensajes->estadoVal = $GeneralMensajes::getEstadoValues();
        return $GeneralMensajes;
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
        $GeneralMensajes = GeneralMensajes::findOrFail($id);
        $GeneralMensajes->setEstadoAttribute($request->estado);
        $GeneralMensajes->id_agente = auth()->user()->id;

        $GeneralMensajes->save();
        return $GeneralMensajes;
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
         $GeneralMensajes= GeneralMensajes::destroy($request->id);
         return $GeneralMensajes;
    }
}
