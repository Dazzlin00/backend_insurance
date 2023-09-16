<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\TipoPoliza;
use App\Models\TipoPoliza_Cobertura;
use Illuminate\Support\Facades\DB;

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

    public function getAllTypes()
    {
        $TipoPoliza = DB::table('tipo_polizas')
            ->join('tipo_poliza__coberturas', 'tipo_polizas.id', '=','tipo_poliza__coberturas.id_tipo_poliza')
            ->select('tipo_polizas.id', 'tipo_polizas.descripcion', 'tipo_polizas.created_at', DB::raw('COUNT(tipo_poliza__coberturas.id_cobertura) as coberturas') )
            ->groupBy('tipo_polizas.id','tipo_polizas.descripcion','tipo_polizas.created_at')
            ->get();

        return $TipoPoliza;
    }

    public function getTypePoliza($id)
    {
        $TipoPoliza = TipoPoliza::findOrFail($id);

        $TipoPoliza->tipo_coberturas = TipoPoliza_Cobertura::where('id_tipo_poliza', $id)->pluck('id_cobertura');

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

         foreach ($request->tipo_coberturas as $tc) {
            $tip = new TipoPoliza_Cobertura();
            if(!$tip::where('id_cobertura',$tc)->where('id_tipo_poliza',$id)->get()){
                $tip->id_tipo_poliza = $id;
                $tip->id_cobertura = $tc;
                $tip->save();
            }
        }

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


