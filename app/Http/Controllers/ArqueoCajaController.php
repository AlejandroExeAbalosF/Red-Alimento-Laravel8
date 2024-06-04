<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\ArqueoCaja;

class ArqueoCajaController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
        return view('panel.cajas.arqueo.create'); 
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //Pone los campos del formulario como requeridos
        $request->validate(
            [
                'monto_inicial' => 'required',
                'total_ventas' => 'required',
                'saldo' => 'required',
            ]);

        $arqueo = new ArqueoCaja();

        $arqueo->monto_inicial = $request->get('monto_inicial');
        $arqueo->total_ventas = $request->get('total_ventas');
        $arqueo->total_compras = $request->get('total_compras');
        $arqueo->saldo = $request->get('saldo');
        $arqueo->faltante = $request->get('faltante');
        $arqueo->sobrante = $request->get('sobrante');
        $arqueo->user_id = auth()->user()->id;

        $arqueo->save();

        return redirect()->route('panel.cajas.index',$arqueo)->with('mensaje','Arqueo realizado y guardado correctamente');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit(ArqueoCaja $arqueo)
    {
        return view('panel.cajas.arqueo.edit', compact('arqueo'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, ArqueoCaja $arqueo)
    {
        $request->validate(
            [
                'monto_inicial' => 'required',
                'total_ventas' => 'required',
                'saldo' => 'required',
            ]);

        $arqueo = new ArqueoCaja();

        $arqueo->monto_inicial = $request->get('monto_inicial');
        $arqueo->total_ventas = $request->get('total_ventas');
        $arqueo->total_compras = $request->get('total_compras');
        $arqueo->saldo = $request->get('saldo');
        $arqueo->faltante = $request->get('faltante');
        $arqueo->sobrante = $request->get('sobrante');

        $arqueo->update();

        return redirect()->route('panel.cajas.arqueo.index',$arqueo)->with('mensaje','Arqueo realizado y guardado correctamente');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}
