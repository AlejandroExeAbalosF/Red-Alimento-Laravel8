<?php

namespace App\Http\Controllers;

use App\Models\Ciclo;
use App\Models\Producto;
use App\Models\StockEstadoGeneral;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class PedidoCompraController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $userND=Auth::user()->nodo_distribuidor_id;
        $userNB=Auth::user()->nodo_base_id;
        $cicloA=Ciclo::where('ciclos.nodo_base_id',$userNB)
        // ->where('ciclos.nodo_distribuidor_id',$userND)
        ->where('ciclos.estado','pendiente')
        ->latest('created_at')
        ->get();
        
        $tabla=[];
        $tablapr=[];
        if(count($cicloA)>0){
            for ($i=0; $i < count($cicloA) ; $i++) { 
                $vec=StockEstadoGeneral::join('prov_prod_nodos','prov_prod_nodos.id','stock_estado_generales.proveedor_producto_nodo_id')
                ->join('nodo_bases','nodo_bases.id','prov_prod_nodos.nodo_base_id')
                ->join('nodo_distribuidors','nodo_distribuidors.id','prov_prod_nodos.nodo_distribuidor_id')
                ->join('productos','productos.id','prov_prod_nodos.producto_id')
                ->join('proveedors','proveedors.id','prov_prod_nodos.proveedor_id')
                ->select('stock_estado_generales.id',
                'nodo_distribuidors.nombre as namend',
                'nodo_bases.nombre as namenb',
                'productos.nombre as namep',
                'proveedors.nombre as nameprov',
                'prov_prod_nodos.stock',
                'prov_prod_nodos.kg_x_cajon',
                'stock_estado_generales.realizado_pedido_compra',
                'stock_estado_generales.llegada_pedido_compra',
                'stock_estado_generales.estado_pedido_compra',
                'stock_estado_generales.stock_pedido_menor',
                'stock_estado_generales.unidad_menor',
                'stock_estado_generales.unidad_mayor',)
                ->where('stock_estado_generales.ciclo_id',$cicloA[$i]->id)
                ->where('stock_estado_generales.estado_pedido_compra','pendiente')
                ->get();
                $vecpr=StockEstadoGeneral::join('prov_prod_nodos','prov_prod_nodos.id','stock_estado_generales.proveedor_producto_nodo_id')
                ->join('nodo_bases','nodo_bases.id','prov_prod_nodos.nodo_base_id')
                ->join('nodo_distribuidors','nodo_distribuidors.id','prov_prod_nodos.nodo_distribuidor_id')
                ->join('productos','productos.id','prov_prod_nodos.producto_id')
                ->join('proveedors','proveedors.id','prov_prod_nodos.proveedor_id')
                ->select('stock_estado_generales.id',
                'nodo_distribuidors.nombre as namend',
                'nodo_bases.nombre as namenb',
                'productos.nombre as namep',
                'proveedors.nombre as nameprov',
                'prov_prod_nodos.stock',
                'prov_prod_nodos.kg_x_cajon',
                'stock_estado_generales.realizado_pedido_compra',
                'stock_estado_generales.llegada_pedido_compra',
                'stock_estado_generales.estado_pedido_compra',
                'stock_estado_generales.stock_pedido_menor',
                'stock_estado_generales.unidad_menor',
                'stock_estado_generales.unidad_mayor',)
                ->where('stock_estado_generales.ciclo_id',$cicloA[$i]->id)
                ->where('stock_estado_generales.estado_pedido_compra','Realizado')
                ->get();

                $tabla=array_merge_recursive($tabla,[$vec]);

                $tablapr=array_merge_recursive($tablapr,[$vecpr]);
            }
            $tabla=collect($tabla);
            $tabla=$tabla->collapse();

            $tablapr=collect($tablapr);
            $tablapr=$tablapr->collapse();
            // return $tabla;
            //$nombreCiclo=$cicloA->nombre;
             //return $SEGs;
            return view('panel.pedidoCompra.tableProducto',compact('tabla','cicloA','tablapr'));
           
        }else{
            
            return view('panel.pedidoCompra.index');    
        }
        
    }

    public function crearPedido(Request $request){
        // return $request;
        date_default_timezone_set('America/Argentina/Salta');
        $productos=explode(",",$request->productos);
        for ($i=0; $i < count($productos); $i++) { 
            $prod=StockEstadoGeneral::findOrFail($productos[$i]);
            $prod->estado_pedido_compra='Realizado';
            $prod->realizado_pedido_compra=date("Y-m-d");
            $prod->llegada_pedido_compra=$request->fchll;
            $prod->save();

        }
        return redirect()->route('pedido.compra.index');
        

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
    public function EditarPedidoCompra($fila)
    { 
        
        $consul=StockEstadoGeneral::join('prov_prod_nodos','prov_prod_nodos.id','stock_estado_generales.proveedor_producto_nodo_id')
        ->join('nodo_bases','nodo_bases.id','prov_prod_nodos.nodo_base_id')
        ->join('nodo_distribuidors','nodo_distribuidors.id','prov_prod_nodos.nodo_distribuidor_id')
        ->join('productos','productos.id','prov_prod_nodos.producto_id')
        ->join('proveedors','proveedors.id','prov_prod_nodos.proveedor_id')
        ->select('stock_estado_generales.id',
        'nodo_distribuidors.nombre as namend',
        'nodo_bases.nombre as namenb',
        'productos.nombre as namep',
        'proveedors.nombre as nameprov',
        'prov_prod_nodos.stock',
        'prov_prod_nodos.kg_x_cajon',
        'stock_estado_generales.realizado_pedido_compra',
        'stock_estado_generales.llegada_pedido_compra',
        'stock_estado_generales.estado_pedido_compra',
        'stock_estado_generales.stock_pedido_menor',
        'stock_estado_generales.unidad_menor',
        'stock_estado_generales.unidad_mayor',)
        ->where('stock_estado_generales.id',$fila)
        ->get();

        //return /*dd*/$consul;

        return view('panel.pedidoCompra.EditarPedidoCompra', compact('consul')); 
        
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, StockEstadoGeneral $consul)
    {

         $consul->estado_pedido_compra = $request->estado_pedido_compra;
         $consul->llegada_pedido_compra = $request->llegada_pedido_compra;
            
         $consul->save();
         //return $consul;
        return redirect()->route('pedido.compra.index', ['filaU' => $consul]);

       /* $request->validate(
            [
                'estado_pedido_compra' => 'required',
                'llegada_pedido_compra' => 'required'
            ]);
        

        $consul->estado_pedido_compra = $request->get('estado_pedido_compra');
        $consul->llegada_pedido_compra = $request->get('llegada_pedido_compra');

        $consul->update($request->all());*/
       //return $consul;
        //return redirect()->route('pedido.compra.index', ['filaU' => $consul])->with('mensaje','Actualización con exito.');
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
