<?php

namespace App\Http\Controllers;

use App\Models\NodoDistribuidorStockDistribuido;
use Illuminate\Http\Request;

class NodoDistribuidorStockDistribuidoController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $info=NodoDistribuidorStockDistribuido::select('nodo_distribuidor_stock_distribuidos.id','nodo_distribuidor_stock_distribuidos.stock_publico_menor','stock_pedido_recibidos.id as idStockpr','stock_pedido_recibidos.ciclo','proveedor_producto_nodos.redondeo','proveedors.nombre')
        ->join('stock_pedido_recibidos','stock_pedido_recibidos.id','=','nodo_distribuidor_stock_distribuidos.stock_p_r_id')
        ->join('proveedor_producto_nodos','proveedor_producto_nodos.id','=','stock_pedido_recibidos.proveedor_producto_nodo_id')
        ->join('proveedors','proveedors.id','proveedor_producto_nodos.proveedor_id')
        ->get();
        
        return $info;
        return view('panel.vendedor.hacer_venta.ventaDeProducto');
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
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\NodoDistribuidorStockDistribuido  $nodoDistribuidorStockDistribuido
     * @return \Illuminate\Http\Response
     */
    public function show(NodoDistribuidorStockDistribuido $nodoDistribuidorStockDistribuido)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\NodoDistribuidorStockDistribuido  $nodoDistribuidorStockDistribuido
     * @return \Illuminate\Http\Response
     */
    public function edit(NodoDistribuidorStockDistribuido $nodoDistribuidorStockDistribuido)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\NodoDistribuidorStockDistribuido  $nodoDistribuidorStockDistribuido
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, NodoDistribuidorStockDistribuido $nodoDistribuidorStockDistribuido)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\NodoDistribuidorStockDistribuido  $nodoDistribuidorStockDistribuido
     * @return \Illuminate\Http\Response
     */
    public function destroy(NodoDistribuidorStockDistribuido $nodoDistribuidorStockDistribuido)
    {
        //
    }
}
