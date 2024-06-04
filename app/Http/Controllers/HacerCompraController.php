<?php

namespace App\Http\Controllers;
use Barryvdh\DomPDF\Facade as PDF;
use App\Models\Ciclo;
use App\Models\DetallePedidoCliente;
use App\Models\NodoDistribuidorStockDistribuido;
use App\Models\PedidoCliente;
use App\Models\Producto;
use App\Models\Proveedor;
use App\Models\StockEstadoGeneral;
use App\Models\StockPedidoRecibido;
use Illuminate\Http\Request;
use PDO;

class HacerCompraController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        
        $ciclo = Ciclo::where('ciclos.estado','pendiente')
        ->get();
        // return $info;
        return view('panel.compraPro.compraProveedor', compact('ciclo'));

        
        
        

    }

    public function getProveedorCiclo(Request $request)
    {
        
        if (isset($request->texto)) {
            $info = Proveedor::select('proveedors.id','proveedors.nombre')
            ->join('prov_prod_nodos','prov_prod_nodos.proveedor_id','=','proveedors.id')
            ->join('stock_estado_generales','stock_estado_generales.proveedor_producto_nodo_id','=','prov_prod_nodos.id')
            ->where('stock_estado_generales.stock_pedido_menor','>', 0)
            ->where('stock_estado_generales.ciclo_id','=',$request->texto)
            ->get();
            return response()->json(
                [
                    'lista' => $info,
                    ' success' => true
                ]
            );
        } else {
            return response()->json(
                [
                    'success' => false
                ]
            );
        }
    }

            
    public function getProductosProv(Request $request){

        if (isset($request->id_Ciclo)) {
            
            $info = StockEstadoGeneral::select('stock_estado_generales.id','productos.nombre')
            ->join('prov_prod_nodos','prov_prod_nodos.id','=','stock_estado_generales.proveedor_producto_nodo_id')
            ->join('productos','productos.id','=','prov_prod_nodos.producto_id')
            ->join('proveedors','proveedors.id','=','prov_prod_nodos.proveedor_id')
            ->where('stock_estado_generales.ciclo_id','=',$request->id_Ciclo)
            ->where('proveedors.id','=',$request->id_Prov)
            ->get();
            return response()->json(
                [
                    'lista' => $info,
                    'success' => true
                ]
            );
        } else {
            return response()->json(
                [
                    'success' => false
                ]
            );
        }  
    }


    public function getProductosPedido(Request $request){

        if (isset($request->id_Ciclo)) {
            
            $info = StockEstadoGeneral::select(
                'stock_estado_generales.id',
                'productos.nombre',
                'stock_estado_generales.stock_pedido_mayor','stock_estado_generales.unidad_mayor',
                'prov_prod_nodos.precio_x_cajon')
                ->join('prov_prod_nodos','prov_prod_nodos.id','=','stock_estado_generales.proveedor_producto_nodo_id')
                ->join('productos','productos.id','=','prov_prod_nodos.producto_id')
                ->join('proveedors','proveedors.id','=','prov_prod_nodos.proveedor_id')
                ->where('stock_estado_generales.ciclo_id','=',$request->id_Ciclo)
                ->where('proveedors.id','=',$request->id_Prov)
                ->get();
            return response()->json(
                [
                    'lista' => $info,
                    'success' => true
                ]
            );
        } else {
            return response()->json(
                [
                    'success' => false
                ]
            );
        }  
    }

public function getGenerarOrden(Request $request){
        
        $pdf= \PDF::loadView('panel.compraPro.pdf_ordenPedidos', compact('request'));
        $pdf->render();
         return $pdf->stream('Orden de Pedido.pdf');

}


    
    // public function prod(Request $request){
    //  $info=NodoDistribuidorStockDistribuido::select('nodo_distribuidor_stock_distribuidos.id','nodo_distribuidor_stock_distribuidos.stock_publico_menor')
    //     if(isset($request->texto)){

    //         return response()->json(
    //             [
    //                 'lista' => $subcategorias,
    //                 'success' => true
    //             ]
    //             );
    //     }else{
    //         return response()->json(
    //             [
    //                 'success' => false
    //             ]
    //             );

    //     }
    // }

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
        return $request->all();
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
        //
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

    // public function getProductInfo($producto_id)
    // {

    //     //$producto_id = $request->get('producto_id');

    //     // $info2=NodoDistribuidorStockDistribuido::select('nodo_distribuidor_stock_distribuidos.id','nodo_distribuidor_stock_distribuidos.stock_publico_menor','stock_pedido_recibidos.id as idStockpr','stock_pedido_recibidos.ciclo','proveedor_producto_nodos.redondeo','productos.nombre')
    //     //  ->join('stock_pedido_recibidos','stock_pedido_recibidos.id','=','nodo_distribuidor_stock_distribuidos.stock_p_r_id')
    //     //  ->join('proveedor_producto_nodos','proveedor_producto_nodos.id','=','stock_pedido_recibidos.proveedor_producto_nodo_id')
    //     //  ->join('productos','productos.id','proveedor_producto_nodos.producto_id')
    //     //  ->where('nodo_distribuidor_stock_distribuidos.stock_publico_menor','>',0)
    //     //  ->where('nodo_distribuidor_stock_distribuidos.id', '=', $producto_id)
    //     //  ->get();

    //     // return json_encode($info2);
    // }
}
