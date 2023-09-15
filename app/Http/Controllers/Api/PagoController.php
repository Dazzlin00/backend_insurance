<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Pago;
use App\Models\Poliza;
use App\Models\User;
use Illuminate\Http\Request;

class PagoController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $Pago = Pago::all();

        foreach ($Pago as $p) {
            $poliza = Poliza::where('id', $p->id_poliza)->first();
            $p->num_poliza = $poliza->num_poliza;
            $usuario = User::where('id', $poliza->id_usuario)->first();
            $p->name = $usuario->name;
        }

        return $Pago;
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $Pago = new Pago();
        $Pago->id_poliza = Poliza::where('num_poliza', $request->num_poliza)->value('id');
        $Pago->numero_transaccion = $request->numero_transaccion;
        $Pago->monto = $request->monto;
        $Pago->fecha_pago = $request->fecha_pago;
        $Pago->descripcion = $request->descripcion;
        $Pago->setEstadoAttribute('No Contestado');

        $Pago->save();
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $Pago = Pago::join('polizas', 'polizas.id', '=', 'pagos.id_poliza')
        ->join('users', 'users.id', '=', 'polizas.id_usuario')
        ->select('pagos.*', 'users.numid as numid', 'users.name as username', 'polizas.num_poliza')
        ->findOrFail($id);
        $Pago->estadoVal = $Pago::getEstadoValues();
        return $Pago;
    }

    public function verMisPagos()
    {
        $pagos = Pago::join('polizas', 'polizas.id', '=', 'pagos.id_poliza')
            ->where('polizas.id_usuario', auth()->user()->id)
            ->select('pagos.*', 'polizas.num_poliza as num_poliza')
            ->get();
        return $pagos;
    }

    public function verMiPago($id)
    {
        $pago = Pago::join('polizas', 'polizas.id', '=', 'pagos.id_poliza')
            ->join('users', 'users.id', '=', 'polizas.id_usuario')
            ->select('pagos.*', 'users.numid as numid', 'users.name as username', 'polizas.num_poliza')
            ->findOrFail($id);
        $pago->estadoVal = $pago::getEstadoValues();
        return $pago;
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
        $Pago = Pago::findOrFail($id);
        $Pago->id_poliza = Poliza::where('num_poliza', $request->num_poliza)->value('id');
        $Pago->numero_transaccion = $request->numero_transaccion;
        $Pago->monto = $request->monto;
        $Pago->fecha_pago = $request->fecha_pago;
        $Pago->descripcion = $request->descripcion;
        $Pago->setEstadoAttribute($request->estado);
        $Pago->save();
        
        return $Pago;
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(Request $request)
    {
        $Pago= Pago::destroy($request->id);
         return $Pago;
    }
}
