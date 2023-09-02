<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Helpers\Helper;
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

        if (empty($tipo_siniestro)) {

            Helper::sendError('No hay tipos de siniestros registrados.');

        } else {
            return $tipo_siniestro;
        }
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
        $tipo_siniestro = new TipoSiniestro();
        $tipo_siniestro->descripcion = $request->descripcion;

        if (empty($tipo_siniestro->descripcion)) {
            $response = [
                'code' => 422,
                'message' => 'El campo descripción es obligatorio.',
            ];

            return response()->json($response, 422);
        } else {
            $tipo_siniestro->save();

            return response()->json($tipo_siniestro, 201);
        }


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
    public function update(Request $request, $id)
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
    public function destroy(Request $request)
    {
        $tipo_siniestro = TipoSiniestro::destroy($request->id);
        return $tipo_siniestro;
    }
}