<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Reclamo;
use App\Models\Poliza;
use App\Models\User;
use Illuminate\Http\Request;

class ReclamoController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //MUESTRA TODOS LOS RECLAMOS
        $reclamos = Reclamo::all();

        //OBTENEMOS LA DESCRIPCION DE TIPO POLIZA
        foreach ($reclamos as $reclamo) {
            $poliza = Poliza::join('reclamo_polizas', 'reclamo_polizas.id_poliza', '=', 'polizas.id')
            ->where('id', $reclamo->id)->first();
            $reclamo->num_poliza = $poliza->num_poliza;

            $usuario = User::where('id', $poliza->id_usuario)->first();
            $reclamo->name = $usuario->name;
        }


        return $reclamos;
    }

    public function VerMisReclamos()
    {
        $reclamo = Reclamo::join('polizas', function ($join){
             $join->where('polizas.id_usuario', '=', auth()->user()->id);
            })
            ->join('reclamo_polizas', 'reclamo_polizas.id_poliza', '=', 'polizas.id')
            ->get();

        return $reclamo;

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
        $Reclamo= new Reclamo();
        $Reclamo->numero_reclamo= $request->numero_reclamo;
        $Reclamo->fecha_reclamo= $request->fecha_reclamo;
        $Reclamo->descripcion= $request->descripcion;
       

        $Reclamo->save();
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $Reclamo= Reclamo::findOrFail($id);
        return $Reclamo;
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
        $Reclamo= Reclamo::findOrFail($id);
        $Reclamo->numero_reclamo= $request->numero_reclamo;
        $Reclamo->fecha_reclamo= $request->fecha_reclamo;
        $Reclamo->descripcion= $request->descripcion;
       

        $Reclamo->save();
        return $Reclamo;
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
        $Reclamo= Reclamo::destroy($request->id);
        return $Reclamo;
    }
}
