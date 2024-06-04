<?php

namespace App\Http\Controllers;

use App\Models\Ciclo;
use App\Models\Categoria;

use App\Mail\correoMailable;
use Illuminate\Http\Request;
use App\Models\PedidoCliente;
use App\Models\Prov_prod_nodo;
use App\Models\NodoDistribuidor;
use App\Models\StockEstadoGeneral;
use PHPMailer\PHPMailer\PHPMailer;
use App\Models\DetallePedidoCliente;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Mail;
use App\Models\ProveedorProductoNodo;
use Illuminate\Support\Facades\Redirect;

class HacerPedidoController extends Controller
{
    public function index(Request $request)
    {
        // $resta=ProveedorProductoNodo::where('proveedor_producto_nodos.id','=',3)
        // ->get();

        $buscarpor = $request->get('buscarpor');
        $categoria = Categoria::all();

        $cicloA = Ciclo::where('ciclos.estado', 'activo')
            ->get();
        $productos = [];
        $v = true;
        for ($i = 0; $i < count($cicloA); $i++) {
            $Tproductos = StockEstadoGeneral::join('prov_prod_nodos', 'prov_prod_nodos.id', 'stock_estado_generales.proveedor_producto_nodo_id')
                ->join('productos', 'productos.id', '=', 'prov_prod_nodos.producto_id')
                ->join('categorias', 'categorias.id', '=', 'productos.categoria_id')
                //->where('productos.nombre','like','%'.$buscarpor.'%')
                ->where('stock_estado_generales.ciclo_id', $cicloA[$i]->id)

                ->select('prov_prod_nodos.stock', 'prov_prod_nodos.kg_x_cajon', 'stock_estado_generales.id', 'prov_prod_nodos.precio_final', 'productos.nombre', 'productos.imagen', 'productos.descripcion')
                ->get();
            //->simplePaginate(8);
            $productos = array_merge_recursive($productos, [$Tproductos]);
            // array_push($Tproductos , $productos);
            //  if($v)
            //  {
            //     $Tproductos= $productos;
            //     $v= false;
            //  }else{
            //     $Tproductos= array_merge_recursive($Tproductos , $productos); 
            //     //$Tproductos[]=$productos;
            //  };
            // $Tproductos= array_combine($Tproductos, [$productos]);
            $productos = array_values($productos);
        };
        // for($i=0; $i < count($productos); $i++ )
        // { return $productos[$i];}
        //  return  count($productos);
        //     $productos= StockEstadoGeneral::join('prov_prod_nodos','prov_prod_nodos.id','stock_estado_generales.proveedor_producto_nodo_id')
        //     ->join('productos','productos.id','=','prov_prod_nodos.producto_id') 
        //     ->join('categorias','categorias.id','=','productos.categoria_id')
        //     ->where('productos.nombre','like','%'.$buscarpor.'%')
        //     ->where('stock_estado_generales.ciclo_id', $cicloA[0]->id)
        //     ->select('prov_prod_nodos.stock','prov_prod_nodos.kg_x_cajon','prov_prod_nodos.id','prov_prod_nodos.precio_final','productos.nombre','productos.imagen','productos.descripcion') 
        //     ->simplePaginate(8);
        //return $productos;
        return view('index', compact('productos', 'categoria', 'buscarpor'));
    }
    public function cart()
    {

        $pedido = PedidoCliente::all();
        $nodosD = NodoDistribuidor::all();
        $cartCollection = \Cart::getContent();
        return view('cart')->withTitle('RED DE ALIMENTO STORE | CART')->with([
            'cartCollection' => $cartCollection,
            'nodosD' => $nodosD, 'pedido' => $pedido
        ]);
    }
    // trae los productos seleccionados en el carrito
    public function add(Request $request)
    {
        //return $request;

        \Cart::add(array(
            'id' => $request->id,
            'name' => $request->name,
            'price' => $request->price,
            'quantity' => $request->quantity,
            'kgxcj' => $request->kgxcj,
            'attributes' => array(
                'imagen' => $request->imagen,

            )
        ));

        return Redirect()->route('indexPublic')->with('seccess_msg', 'Producto Agregado');
    }

    public function remove(Request $request)
    {
        \Cart::remove($request->id);
        return Redirect()->route('cart.index')->with('seccess_msg', 'producto eliminado');
    }

    public function update(Request $request)
    {
        \Cart::update(
            $request->id,
            array(
                'quantity' => array(
                    'relative' => false,
                    'value' => $request->quantity
                ),
            )
        );
        return redirect()->route('cart.index')->with('success_msg', 'Carrito actualizado');
    }
    public function clear()
    {
        \Cart::clear();
        return redirect()->route('cart.index')->with('success_msg', 'carrito vacio');
    }

    //categorias

    public function categoria(Request $request)
    {

        $categoria = Categoria::all();

        return view('cart', compact('categoria'));
    }



    public function productoCategoria(Request $request)
    {

        if (isset($request->texto)) {
            $produCategoria = ProveedorProductoNodo::join('productos', 'productos.id', '=', 'proveedor_producto_nodos.producto_id')
                ->join('categorias', 'categorias.id', '=', 'productos.categoria_id')
                ->select('productos.id', 'productos.nombre', 'productos.imagen', 'productos.descripcion', 'proveedor_producto_nodos.redondeo', 'categorias.nombre as cat')
                ->where('productos.categoria_id', '=', $request->texto)

                ->get();

            return response()->json(
                [
                    'lista' => $produCategoria,
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


    public function guardarPedido(Request $request)
    {
        // return $request->idPPN[0];
        $iduser = auth()->id();
        $total = request('totalP');
        $nodoD = request('idnodo');

        $idul = PedidoCliente::create(
            [
                'usuario_id' => $iduser,
                'nodo_distribuidor_id' => $nodoD,
                'total' => $total,
                'estado'=> "Activo",
            ]
        );
        //return $idul;

        for ($i = 0; $i < count($request->idPPN); ++$i) {
            //return $request;
            DetallePedidoCliente::create(
                [
                    'stock_estado_general_id' => $request->idPPN[$i],
                    'pedido_cliente_id' => $idul->id,
                    'cantidad_producto' => $request->quantP[$i],
                    'precio_unitario' => $request->preP[$i],
                    'sub_total' => $request->subTP[$i],
                    'estado'=> "Activo",
                ]
            );
            $a= StockEstadoGeneral::findOrFail($request->idPPN[$i]);

            $a = Prov_prod_nodo::findOrFail($a->proveedor_producto_nodo_id);

            $r = StockEstadoGeneral::findOrFail($request->idPPN[$i]);
            //return $resta;
            $r->stock_pedido_menor = $r->stock_pedido_menor + $request->quantP[$i];
            if($r->redondeo_pedido == null){
                $r->redondeo_pedido = $a->kg_x_cajon;  
                $r->stock_pedido_mayor= 1;
            }
            //return $r->stock_pedido_mayor;
            if($r->stock_pedido_menor <= $r->redondeo_pedido ){
                     
            }else{
                while($r->stock_pedido_menor <= $r->redondeo_pedido){
                    $r->redondeo_pedido = $r->redondeo_pedido + $a->kg_x_cajon;
                    $r->stock_pedido_mayor = $r->stock_pedido_mayor + 1;
                }
                // $r->redondeo_pedido = $r->redondeo_pedido + ($r->stock_pedido_mayor * $a->kg_x_cajon);

                // $kk= $request->quantP[$i] / $a->kg_x_cajon; 
                // $r->stock_pedido_mayor = $r->stock_pedido_mayor + ceil($kk);
                // if()
                // $r->redondeo_pedido = $r->redondeo_pedido + (ceil($kk) * $a->kg_x_cajon);
            }
            if ($r->stock_pedido_mayor <= $a->stock ) {                
                
                $r->save();
                //return $r;
            }

            
            // $stock_promesa2= $resta->kg_x_cajon;
            // $resultado= $stock_promesa2 - $request->quantP[$i] ;
            // $resta->kg_x_cajon= $resultado;

            // $resta->save();
        };
        
        $mail = new PHPMailer(true);
        $mail->SMTPDebug = 2;
        $mail->IsSMTP();
        $mail->SMTPAuth = true;
        //$mail->SMTPSecure = "ssl";
        $mail->SMTPSecure = 'tls';
        $mail->Host = 'smtp.gmail.com';
        $mail->Port = 587; // TCP port to connect to
        $mail->CharSet = 'UTF-8';
        $mail->Username = 'berrroimam@gmail.com'; //Email para enviar
        $mail->Password = 'empujyttuhjmnzlt'; //Su password
        //Agregar destinatario
        $mail->setFrom('berrroimam@gmail.com', 'sumak kausay');
        $mail->AddAddress('braiansalva2001@gmail.com'); //A quien mandar email
        $mail->SMTPKeepAlive = true;
        $mail->Mailer = "smtp";


        //Content
        $mail->isHTML(true); // Set email format to HTML
        $mail->Subject = 'Pedido';
        $mail->Body    = 'confirmacion de pedido de sumak kausay';
        $mail->AltBody = 'This is the body in plain text for non-HTML mail clients';

        if (!$mail->send()) {
            echo 'Error al enviar email';
            echo 'Mailer error: ' . $mail->ErrorInfo;
        } else {
            echo 'Mail enviado correctamente';
        }
        return Redirect()->route('indexPublic');
    }
}
