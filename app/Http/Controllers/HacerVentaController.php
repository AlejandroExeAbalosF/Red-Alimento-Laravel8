<?php

namespace App\Http\Controllers;

use Barryvdh\DomPDF\Facade as PDF;

use App\Models\Ciclo;
use App\Models\DetallePedidoCliente;
use App\Models\DetalleVenta;
use App\Models\NodoDistribuidorStockDistribuido;
use App\Models\PedidoCliente;
use App\Models\StockEstadoGeneral;
use App\Models\StockPedidoRecibido;
use App\Models\User;
use App\Models\Venta;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use PDO;

class HacerVentaController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {

        // $productos=NodoDistribuidorStockDistribuido::select('nodo_distribuidor_stock_distribuidos.id','nodo_distribuidor_stock_distribuidos.stock_publico_menor','stock_pedido_recibidos.id as idStockpr','stock_pedido_recibidos.ciclo','prov_prod_nodos.redondeo','proveedors.nombre')
        // ->join('stock_pedido_recibidos','stock_pedido_recibidos.id','=','nodo_distribuidor_stock_distribuidos.stock_p_r_id')
        // ->join('prov_prod_nodos','prov_prod_nodos.id','=','stock_pedido_recibidos.proveedor_producto_nodo_id')
        // ->join('proveedors','proveedors.id','prov_prod_nodos.proveedor_id')
        // ->get();
        // return $productos;
        // $info=PedidoCliente::select('pedido_clientes.id','pedido_clientes.total','users.nombre','pedido_clientes.usuario_id')
        // ->join('users','users.id','=','pedido_clientes.usuario_id')->get();
        
        // $info = PedidoCliente::join('users','users.id','=','pedido_clientes.usuario_id')
        //     ->join('detalle_pedido_clientes','detalle_pedido_clientes.pedido_cliente_id','=','pedido_clientes.id')
        //     ->join('prov_prod_nodos','prov_prod_nodos.id','=','detalle_pedido_clientes.proveedor_producto_nodo_id')
        //     ->join('stock_estado_generales','stock_estado_generales.proveedor_producto_nodo_id','=','prov_prod_nodos.id')
        //     ->select('pedido_clientes.id','users.nombre','stock_estado_generales.ciclo_id as idStockEG')
        //     ->where('stock_estado_generales.ciclo_id','=',1)
        //     ->get();
        // $info = StockEstadoGeneral::select('pedido_clientes.id','users.nombre','stock_estado_generales.ciclo_id as idStockEG')
        // ->join('prov_prod_nodos','prov_prod_nodos.id','=','stock_estado_generales.proveedor_producto_nodo_id')
        // ->join('detalle_pedido_clientes','detalle_pedido_clientes.proveedor_producto_nodo_id','=','prov_prod_nodos.id')
        // ->join('pedido_clientes','pedido_clientes.id','=','detalle_pedido_clientes.pedido_cliente_id')
        // ->join('users','users.id','=','pedido_clientes.usuario_id')
        // ->where('stock_estado_generales.ciclo_id','=','2')
        // ->get();
        // $info = PedidoCliente::join('users','users.id','=','pedido_clientes.usuario_id')
        //     ->join('detalle_pedido_clientes','detalle_pedido_clientes.pedido_cliente_id','=','pedido_clientes.id')
        //     ->join('prov_prod_nodos','prov_prod_nodos.id','=','detalle_pedido_clientes.proveedor_producto_nodo_id')
        //     ->join('stock_estado_generales','stock_estado_generales.proveedor_producto_nodo_id','=','prov_prod_nodos.id')
        //     ->select('pedido_clientes.id','users.nombre','pedido_clientes.fecha_hora')
        //     ->where('stock_estado_generales.ciclo_id','=',1)
        //     ->get();
        // $cab= Venta::join('users','users.id','=','ventas.usuario_id')
        // ->select('users.nombre','ventas.id','ventas.fecha_hora','ventas.total_venta')
        // ->where('ventas.id','=',5)
        // ->get();
        // return $cab[0]->id;
        $info = StockEstadoGeneral::join('prov_prod_nodos','prov_prod_nodos.id','=','stock_estado_generales.proveedor_producto_nodo_id')
            ->join('productos','productos.id','prov_prod_nodos.producto_id')
            ->select('stock_estado_generales.id','productos.nombre','stock_estado_generales.nd_stock_publico_menor','prov_prod_nodos.precio_final')
            ->where('stock_estado_generales.ciclo_id','=',1)
            ->where('stock_estado_generales.nd_stock_publico_menor','>',0)
            ->get();
        // return $info;
        //saber que rol esta asignado al usuario logueado
        // $info=Auth::user();
        // return $info->roles()->first()->name;
        // return $info->roles()->get();
        $userND=Auth::user()->nodo_distribuidor_id;
        $userNB=Auth::user()->nodo_base_id;
        $ciclo = Ciclo::where('ciclos.nodo_base_id',$userNB)
        ->where('ciclos.nodo_distribuidor_id',$userND)
        ->where('ciclos.estado','pendiente')
        ->latest('created_at')
        ->get();
        // return $ciclo;
        $ventas=Venta::join('users','users.id','=','ventas.usuario_id')
        ->select('users.name','ventas.id','ventas.fecha_hora','ventas.total_venta')
        ->get();      
        return view('panel.vendedor.hacer_venta.ventaDeProducto', compact('ciclo','ventas'));

    }

    public function prodTemp(Request $request)
    {
        
        if (isset($request->texto)) {
            $temp = DetallePedidoCliente::select('detalle_pedido_clientes.cantidad_producto', 'detalle_pedido_clientes.precio_unitario', 'detalle_pedido_clientes.sub_total', 'productos.nombre')
                ->join('stock_estado_generales', 'stock_estado_generales.id', '=', 'detalle_pedido_clientes.stock_estado_general_id')
                ->join('prov_prod_nodos', 'prov_prod_nodos.id', '=', 'stock_estado_generales.proveedor_producto_nodo_id')
                ->join('productos', 'productos.id', '=', 'prov_prod_nodos.producto_id')
                ->where('detalle_pedido_clientes.pedido_cliente_id', '=', $request->texto)
                ->get();
            return $temp;
            // $request->session()->push('user.teams', 'developers');

        }
    }

    public function getPedidosCiclo(Request $request)
    {
        
        if (isset($request->texto)) {
            //Usuario cliente pendiente cambiar a Users
            $infos = PedidoCliente::join('users','users.id','=','pedido_clientes.usuario_id')
            ->join('detalle_pedido_clientes','detalle_pedido_clientes.pedido_cliente_id','=','pedido_clientes.id')
            ->join('stock_estado_generales', 'stock_estado_generales.id', '=', 'detalle_pedido_clientes.stock_estado_general_id')
            ->select('pedido_clientes.id','users.name')
            ->where('stock_estado_generales.ciclo_id','=',$request->texto)
            ->get();
            $info=$infos->unique('id');
            
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

    public function getProductosPedido(Request $request){
        
        if (isset($request->texto)) {
            //toy aka
            $info = PedidoCliente::join('detalle_pedido_clientes','detalle_pedido_clientes.pedido_cliente_id','=','pedido_clientes.id')
            ->join('stock_estado_generales', 'stock_estado_generales.id', '=', 'detalle_pedido_clientes.stock_estado_general_id')
            ->join('prov_prod_nodos','prov_prod_nodos.id','=','stock_estado_generales.proveedor_producto_nodo_id')
            ->join('productos','productos.id','prov_prod_nodos.producto_id')
            ->select('detalle_pedido_clientes.cantidad_producto','detalle_pedido_clientes.precio_unitario','detalle_pedido_clientes.sub_total','productos.nombre','stock_estado_generales.id','stock_estado_generales.nd_stock_publico_menor')
            ->where('detalle_pedido_clientes.pedido_cliente_id','=',$request->texto)
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

    public function getProductosCiclo(Request $request){
        if (isset($request->texto)) {
            
            $info = StockEstadoGeneral::join('prov_prod_nodos','prov_prod_nodos.id','=','stock_estado_generales.proveedor_producto_nodo_id')
            ->join('productos','productos.id','prov_prod_nodos.producto_id')
            ->select('stock_estado_generales.id','productos.nombre','stock_estado_generales.nd_stock_publico_menor','prov_prod_nodos.precio_final')
            ->where('stock_estado_generales.ciclo_id','=',$request->texto)
            ->where('stock_estado_generales.nd_stock_publico_menor','>',0)
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

    public function getProductosInfo(Request $request){
        if (isset($request->texto)) {
            //asdas
            $info = StockEstadoGeneral::join('prov_prod_nodos','prov_prod_nodos.id','=','stock_estado_generales.proveedor_producto_nodo_id')
            ->join('productos','productos.id','prov_prod_nodos.producto_id')
            ->select('stock_estado_generales.id','productos.nombre','stock_estado_generales.nd_stock_publico_menor','prov_prod_nodos.precio_final')
            ->where('stock_estado_generales.id','=',$request->texto)
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
        date_default_timezone_set('America/Argentina/Salta');
        // return $request->all();
        if($request->idC == "nada"){
            $cabeceraV=Venta::create([
                'fecha_hora'=>date('y-m-d h:i:s'),
                'total_venta'=>$request->total,
                // 'tipo_factura'
            ]);
        }else{
            $cabeceraV=Venta::create([
                'usuario_id'=>$request->idC,
                'fecha_hora'=>date('y-m-d h:i:s'),
                'total_venta'=>$request->total,
                // 'tipo_factura'
            ]);
        }
        for($i=0;$i<count($request->idP);$i++){
            DetalleVenta::create([
                'ventas_id'=>$cabeceraV->id,
                'stock_estado_general_id'=>$request->idP[$i],

                'cantidad_producto'=>$request->cantidad_producto[$i],
                'precio_unitario'=>$request->precio_unitario[$i],
                'sub_total'=>$request->sub_total[$i]
            ]);
        }
        return redirect()->route('v')->with('mensaje','Venta Generada con exito');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($venta)
    {
        // return $venta;
        $cab= Venta::join('users','users.id','=','ventas.usuario_id')
        ->select('users.name','ventas.id','ventas.fecha_hora','ventas.total_venta')
        ->where('ventas.id','=',$venta)
        ->get();

        $detalles=DetalleVenta::join('stock_estado_generales','stock_estado_generales.id','=','detalle_ventas.stock_estado_general_id')
        ->join('prov_prod_nodos','prov_prod_nodos.id','=','stock_estado_generales.proveedor_producto_nodo_id')
        ->join('productos','productos.id','=','prov_prod_nodos.producto_id')
        ->orWhere('detalle_ventas.ventas_id','=',$venta)
        ->select('productos.nombre','detalle_ventas.cantidad_producto','detalle_ventas.precio_unitario','detalle_ventas.sub_total')
        ->get();
        // return $detalles;
        $pdf= \PDF::loadView('panel.vendedor.hacer_venta.pdf_factura', compact('cab','detalles'));
        $pdf->render();
         return $pdf->stream('factura.pdf');
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

   



    public function exportarProductosPDF($venta) {
        return $venta;
        // $productos = Producto::where('usuario_id', auth()->user()->id)->get();
        // $pdf= \PDF::loadView('panel.vendedor.lista_productos.pdf_productos', compact('productos'));
        // $pdf->render();
        //  return $pdf->stream('productos.pdf');
    }



    // public function getProductInfo($producto_id)
    // {

    //     //$producto_id = $request->get('producto_id');

    //     // $info2=NodoDistribuidorStockDistribuido::select('nodo_distribuidor_stock_distribuidos.id','nodo_distribuidor_stock_distribuidos.stock_publico_menor','stock_pedido_recibidos.id as idStockpr','stock_pedido_recibidos.ciclo','prov_prod_nodos.redondeo','productos.nombre')
    //     //  ->join('stock_pedido_recibidos','stock_pedido_recibidos.id','=','nodo_distribuidor_stock_distribuidos.stock_p_r_id')
    //     //  ->join('prov_prod_nodos','prov_prod_nodos.id','=','stock_pedido_recibidos.proveedor_producto_nodo_id')
    //     //  ->join('productos','productos.id','prov_prod_nodos.producto_id')
    //     //  ->where('nodo_distribuidor_stock_distribuidos.stock_publico_menor','>',0)
    //     //  ->where('nodo_distribuidor_stock_distribuidos.id', '=', $producto_id)
    //     //  ->get();

    //     // return json_encode($info2);
    // }
}
