<?php

namespace App\Http\Controllers;

use App\Models\Ciclo;
use App\Models\DetallePedidoCliente;
use App\Models\PedidoCliente;
use App\Models\Prov_prod_nodo;
use App\Models\ProveedorProductoNodo;
use App\Models\StockEstadoGeneral;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class ProcesoCicloController extends Controller
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
        
        // $cicloA=Ciclo::
        // // where('ciclos.nodo_base_id',$userNB)
        // // ->where('ciclos.nodo_distribuidor_id',$userND)
        // whereNodo_base_idAndNodo_distribuidor_id($userNB,$userND)
        // ->whereEstadoAndEstado('activo','pendiente')
        // // ->where('ciclos.estado','activo')
        // // ->OrWhere('ciclos.estado','pendiente')
        // ->latest('created_at')
        // ->first();
        // tado loco mano ->

        //establese el ultimo ciclo seguun el usuario logueado
        
        $cicloA=Ciclo::where(function($query) use($userNB,$userND){
            $query->where('nodo_base_id',$userNB)
                  ->where('nodo_distribuidor_id',$userND);      
        })
        ->where(function($query){
            $query->where('estado','activo')
                  ->OrWhere('estado','pendiente');
        })
        ->latest('created_at')
        ->first();
        // return $cicloA;
        if($cicloA){
            $SEGs=StockEstadoGeneral::join('prov_prod_nodos','prov_prod_nodos.id','stock_estado_generales.proveedor_producto_nodo_id')
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
            'stock_estado_generales.estado_pedido_compra',
            'stock_estado_generales.stock_pedido_menor',
            'stock_estado_generales.unidad_menor',
            'stock_estado_generales.unidad_mayor',
            'stock_estado_generales.nb_cantidad_pedido_recibido_menor',
            'stock_estado_generales.nb_cantidad_pedido_recibido_mayor',
            'stock_estado_generales.nd_cantidad_pedido_recibido_menor')
            ->where('stock_estado_generales.ciclo_id',$cicloA->id)
            ->get();
            $nombreCiclo=$cicloA->nombre;
            //  return $SEGs;
            return view('panel.ciclo.tableStockEStadoGeneral.index',compact('SEGs','cicloA'));
           
        }else{
            return view('panel.ciclo.index');        
        }
        // return view('panel.ciclo.index'); 
       
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
    public function store(Request $procesoCiclo)
    {
        $fechaH= $procesoCiclo->datetime;
        $userND=Auth::user()->nodo_distribuidor_id;
        $userNB=Auth::user()->nodo_base_id;
        if($userND != null){
            $tabla=Prov_prod_nodo::join('nodo_bases','nodo_bases.id','prov_prod_nodos.nodo_base_id')
            ->join('nodo_distribuidors','nodo_distribuidors.id','prov_prod_nodos.nodo_distribuidor_id')
            ->join('productos','productos.id','prov_prod_nodos.producto_id')
            ->join('proveedors','proveedors.id','prov_prod_nodos.proveedor_id')
            ->select('prov_prod_nodos.id',
            'nodo_distribuidors.nombre as namend',
            'nodo_bases.nombre as namenb',
            'productos.nombre as namep',
            'proveedors.nombre as nameprov',
            'prov_prod_nodos.stock',
            'prov_prod_nodos.kg_x_cajon')
            ->where('prov_prod_nodos.nodo_distribuidor_id',$userND)
            ->where('prov_prod_nodos.nodo_base_id',$userNB)
            ->get();
           //return $tabla;
            return view('panel.ciclo.selectProductoTable',compact('tabla','fechaH'));
        }else{

        }
        // return Auth::user()->nodo_distribuidor_id;
        
    }

    public function getProcesoCiclo(Request $request){
        date_default_timezone_set('America/Argentina/Salta');
        $userND=Auth::user()->nodo_distribuidor_id;
        $userNB=Auth::user()->nodo_base_id;
        
        // return !empty($request->fch);
        if(empty($request->fch)){
            
            $fh=null;
        }else{
            $fechaHora=$request->fch;
            $fechaHora=explode("T",$fechaHora);
            $fh=$fechaHora[0].' '.$fechaHora[1];
        }
        
        
        $mesNum=date('n');
        $anio=date('Y');
        switch($mesNum){
            case 1:
                $mesNom='Enero';
                break;
            case 2:
                $mesNom='Febrero';
                break;
            case 3:
                $mesNom='Marzo';
                break;
            case 4:
                $mesNom='Abril';
                break;
            case 5:
                $mesNom='Mayo';
                break;
            case 6:
                $mesNom='Junio';
                break;
            case 7:
                $mesNom='Julio';
                break;
            case 8:
                $mesNom='Agosto';
                break;
            case 9:
                $mesNom='Septiembre';
                break;
            case 10:
                $mesNom='Octubre';
                break;
            case 11:
                $mesNom='Noviembre';
                break;
            case 12:
                $mesNom='Diciembre';
                break;
            default:
                $mesNom='error';
        }

        $ultimoNombreCiclo=Ciclo::where('ciclos.nodo_distribuidor_id',$userND)
        ->where('ciclos.nodo_base_id',$userNB)
        ->latest('created_at')
        ->first();
        // return $ultimoNombreCiclo;
        if($ultimoNombreCiclo){
            $vectNombreCiclo=explode(".",$ultimoNombreCiclo->nombre);
            if($vectNombreCiclo[2]==$anio){
                if($vectNombreCiclo[1]== $mesNom){
                    $numCiclo=$vectNombreCiclo[0]+1;
                    $nuevoNombreCiclo=$numCiclo.'.'.$mesNom.'.'.$anio;
                }else{
                    $nuevoNombreCiclo='1.'.$mesNom.'.'.$anio;
                }
            }else{
                $nuevoNombreCiclo='1.'.$mesNom.'.'.$anio;
            }
        }else{
            $nuevoNombreCiclo='1.'.$mesNom.'.'.$anio;
        }
        
        // return $nuevoNombreCiclo;
        //$monthName = date("F", mktime(0, 0, 0, $monthNumber, 10));
        $proS=$request->productos;
        $produtos=explode(",",$proS);
        
        $ciclo=Ciclo::create([
            'nodo_base_id'=>$userNB,
            'nodo_distribuidor_id'=>$userND,
            'fecha_limite'=>$fh,
            'fehca_inicio'=>date('Y-m-d'),
            'nombre'=>$nuevoNombreCiclo,
            'estado'=>'activo',
            
        ]);
        
        
        for($i=0;$i<count($produtos);$i++){
            // $p=ProveedorProductoNodo::join('nodo_bases','nodo_bases.id','proveedor_producto_nodos.nodo_base_id')
            // ->join('nodo_distribuidors','nodo_distribuidors.id','proveedor_producto_nodos.nodo_distribuidor_id')
            // ->join('productos','productos.id','proveedor_producto_nodos.producto_id')
            // ->select('proveedor_producto_nodos.id','nodo_distribuidors.nombre as namend','nodo_bases.nombre as namenb','productos.nombre as namep','proveedor_producto_nodos.stock_promesa_unitario')
            // ->where('proveedor_producto_nodos.id',$produtos[$i])
            // ->get();
            StockEstadoGeneral::create([
                'proveedor_producto_nodo_id'=>$produtos[$i],
                'ciclo_id'=>$ciclo->id,
                'estado_pedido_compra'=>'Pendiente',
                'unidad_menor'=>'kg',// ta mal, Hacerlo generico besito
                'unidad_mayor'=>'Cajon/Fardo',
                
            ]);
        }
        return redirect()->route('proceso.ciclo.index');
        return $request;
    }

    public function closeCiclo(Request $request){
        $ciclo=Ciclo::findOrFail($request->idCiclo);
        $ciclo->estado='cerrado';
        $ciclo->save();
        return redirect()->route('proceso.ciclo.index');
        return $ciclo;
    }

    public function pendienteCiclo(Request $request){
        
        $ciclo=Ciclo::findOrFail($request->idCiclo);
        $ciclo->estado='pendiente';
        $ciclo->save();
        return redirect()->route('proceso.ciclo.index');
        
    }
    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($procesoCiclo)
    {
        return view('panel.ciclo.selectProductoTable');
    }
    public function select()
    {
        return view('panel.ciclo.selectProductoTable');
    }
    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit(StockEstadoGeneral $procesoCiclo)
    {

        // return $procesoCiclo;
        $info=Prov_prod_nodo::select('kg_x_cajon')->findOrFail($procesoCiclo->proveedor_producto_nodo_id);
        // return $info;
        return view('panel.ciclo.tableStockEstadoGeneral.edit',compact('procesoCiclo','info'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request,StockEstadoGeneral $procesoCiclo)
    {
        // return $procesoCiclo;
        
        $request->validate([
            'nb_cantidad_pedido_recibido_mayor' => 'required',
            'nb_cantidad_pedido_recibido_menor' => 'required',
        ]);
        
        $procesoCiclo->update($request->all());    
        $procesoCiclo->nb_cantidad_pedido_recibido_mayor=$request->nb_cantidad_pedido_recibido_mayor;
        $procesoCiclo->nb_cantidad_pedido_recibido_menor=$request->nb_cantidad_pedido_recibido_menor;
        // $procesoCiclo->nd_pedido_cliente_menor=$request->stock_pedido_menor;
        // return $procesoCiclo->nb_cantidad_pedido_recibido_mayor;
        
        if($procesoCiclo->nb_cantidad_pedido_recibido_mayor < $procesoCiclo->stock_pedido_mayor){
            
            $clientesProducto=DetallePedidoCliente::select('cantidad_producto','pedido_cliente_id','id')->where('stock_estado_general_id',$procesoCiclo->id)->get();
            // return $clientesProducto;
            $resulSobrante=$procesoCiclo->nb_cantidad_pedido_recibido_menor;
            $bandera=true;
            for($i=0;$i<count($clientesProducto);$i++){
                
                if($clientesProducto[$i]->cantidad_producto > $resulSobrante){
                    if($bandera){
                        $resulSobrante=$resulSobrante - $clientesProducto[$i]->cantidad_producto;
                        $cantProductoDisponible=$clientesProducto[$i]->cantidad_producto - abs($resulSobrante);
                        $bandera=false;
                        
                    }else{
                        $resulSobrante=0;
                    }
                    
                    $cabeceraPedidoCliente=PedidoCliente::findOrFail($clientesProducto[$i]->pedido_cliente_id);
                    $detallePedido=DetallePedidoCliente::findOrFail($clientesProducto[$i]->id);
                    if($resulSobrante == 0){
                        
                        $cabeceraPedidoCliente->estado="Inativo";//rojo
                        $detallePedido->estado="Inativo";
                    }else{
                        $cabeceraPedidoCliente->estado="Incompleto";//estado pendiente-amarrillo
                        $detallePedido->estado="Incompleto";                        
                        $detallePedido->cantidad_producto_disponible=$cantProductoDisponible;
                    }
                    $cabeceraPedidoCliente->save();
                    $detallePedido->save();
                }else{
                    $cabeceraPedidoCliente=PedidoCliente::findOrFail($clientesProducto[$i]->pedido_cliente_id);
                    $detallePedido=DetallePedidoCliente::findOrFail($clientesProducto[$i]->id);
                    $cabeceraPedidoCliente->estado="Ativo";
                    $detallePedido->estado="Ativo";
                    $cabeceraPedidoCliente->save();
                    $detallePedido->save();
                }
                if($bandera){
                    $resulSobrante=$resulSobrante - $clientesProducto[$i]->cantidad_producto;
                }
                
            }
        }else{
            $clientesProducto=DetallePedidoCliente::select('cantidad_producto','pedido_cliente_id')->where('stock_estado_general_id',$procesoCiclo->id)->get();
            // return $clientesProducto;
            $resulSobrante=$procesoCiclo->nb_cantidad_pedido_recibido_menor;
            $bandera=true;
            for($i=0;$i<count($clientesProducto);$i++){
                
                $cabeceraPedidoCliente=PedidoCliente::findOrFail($clientesProducto[$i]->pedido_cliente_id);
                $cabeceraPedidoCliente->estado="Activo";
                $cabeceraPedidoCliente->save();
                
            }
        }
       
        $procesoCiclo->save();
        return redirect()->route('proceso.ciclo.index');
        
    }
    public function updateCicloBase(Request $request,StockEstadoGeneral $procesoCiclo)
    {
        // return $procesoCiclo;
        
        $request->validate([
            'nb_cantidad_pedido_recibido_menor' => 'required',
            'nd_cantidad_pedido_recibido_menor' => 'required',
        ]);
        
        $procesoCiclo->update($request->all());
        
        $procesoCiclo->nd_stock_publico_menor=$request->nd_cantidad_pedido_recibido_menor;
        $procesoCiclo->nd_pedido_cliente_menor=$request->stock_pedido_menor;
        $procesoCiclo->save();
        return redirect()->route('proceso.ciclo.index');
        
    }

    public function editCicloBase(StockEstadoGeneral $procesoCiclo){//no se usa
        return view('panel.ciclo.tableStockEstadoGeneral.edit',compact('procesoCiclo'));
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
