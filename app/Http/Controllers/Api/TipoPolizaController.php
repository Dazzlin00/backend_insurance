<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\TipoPoliza;

class TipoPolizaController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $TipoPoliza = TipoPoliza::all();
        return $TipoPoliza;
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
        $TipoPoliza= new TipoPoliza();
        $TipoPoliza->descripcion= $request->descripcion;
        $TipoPoliza->save();

    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
         $TipoPoliza= TipoPoliza::findOrFail($id);
        return $TipoPoliza;
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
         $TipoPoliza= TipoPoliza::findOrFail($id);
         $TipoPoliza->descripcion= $request->descripcion;
         
         $TipoPoliza->save();
         return $TipoPoliza;
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(Request $request)
    {
        $TipoPoliza= TipoPoliza::destroy($request->id);
        return $TipoPoliza;
    }
}


