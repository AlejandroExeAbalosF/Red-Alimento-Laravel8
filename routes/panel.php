<?php

use App\Http\Controllers\Admin\HomeController;
use App\Http\Controllers\Admin\UserController;
use App\Http\Controllers\HacerVentaController;
use App\Http\Controllers\HacerVentaNodoDisController;
use App\Http\Controllers\HacerCompraController;
use App\Http\Controllers\NodoDistribuidorStockDistribuidoController;
use Illuminate\Support\Facades\Route;

use App\Http\Controllers\PanelController;
use App\Http\Controllers\CajaController;
use App\Http\Controllers\ArqueoCajaController;
use App\Http\Controllers\CategoriaController;
use App\Http\Controllers\ProductoController;
use App\Http\Controllers\ProveedorController;
use App\Http\Controllers\NodoBaseController;
use App\Http\Controllers\NodoDistribuidorController;
use App\Http\Controllers\Promesa2Controller;
use App\Http\Controllers\Prov_prod_nodoController;
use App\Http\Controllers\Pedido_ClientesController;
use App\Http\Controllers\UsuariosController;

use App\Http\Controllers\HacerPedidoController;
use App\Http\Controllers\HistorialPedidoController;
use App\Http\Controllers\PedidoCompraController;
use App\Http\Controllers\ProcesoCicloController;

Route::get('',[HomeController::class,'index'])->name('admin.home');

Route::resource('user',UserController::class)->names('admin.users');

// Route::get('/users', [UserController::class,'index'])->name('usuarios');

// //Ruta para extraer usuarios por Ajax
// Route::get('/get_users', [UserController::class, 'get_users'])->name('get_users');

Route::get('/', function()
{
    return view('panel.index');
});

//Ruta para el tablero del menu
Route::get('panel',[PanelController::class, 'index'])->name('panel.index');

//Ruta para caja
Route::resource('panel/cajas', CajaController::class)->names('panel.cajas');

Route::resource('panel/cajas/arqueo', ArqueoCajaController::class)->names('panel.cajas.arqueo');

//venta Pedido y Producto
Route::get('/hacer_vent',[HacerVentaController::class,'index'])->name('hacer.ventas');
Route::resource('panel/categorias', CategoriaController::class)->names('panel.categorias');

Route::resource('panel/productos', ProductoController::class)->names('panel.productos');

Route::get('/exportar-productos-pdf/', [HacerVentaController::class, 'exportarProductosPDF'])->name('exportar-productos-pdf');//no funciona

Route::resource('/hventa', HacerVentaController::class)->names('hventa');
// Consultas ajax o javacrit

Route::resource('panel/proveedores', ProveedorController::class)->names('panel.proveedores');



Route::resource('panel/nodo_bases', NodoBaseController::class)->names('panel.nodo_bases');







Route::get('/compraPro',[HacerCompraController::class,'index'])->name('C');

Route::post('/prodTemp',[HacerCompraController::class,'prodTemp']);

// Consultas ajax
Route::post('/getPedidosCiclo',[HacerVentaController::class,'getPedidosCiclo']);

Route::post('/getProductosCiclo',[HacerCompraController::class,'getProductosCiclo']);

Route::post('/getProveedorCiclo',[HacerCompraController::class,'getProveedorCiclo']);

Route::post('/getProductosProv',[HacerCompraController::class,'getProductosProv']);

Route::post('/getProductosPedido',[HacerCompraController::class,'getProductosPedido']);

Route::post('/getGenerarOrden',[HacerCompraController::class,'getGenerarOrden'])->name('generarOrden');

//Route::get('/getProductosProv/{id_Prov}/{id_Ciclo}',[HacerCompraController::class, 'getProductosProv'])->name('test8');

Route::post('/getProductosInfo',[HacerCompraController::class,'getProductosinfo']);

Route::post('generarCompra',[HacerCompraController::class,'store'])->name('generarCompra.store');

Route::post('/generarVenta',[HacerVentaController::class,'store'])->name('generarVenta.store');
//

Route::get('/cliente',[HistorialPedidoController::class,'historial'])->name('historial');
Route::get('/client',[HistorialPedidoController::class,'pedido'])->name('pedido');

//Venta nodo D
Route::get('/Hacer-remito-nodo-Distribuidor',[HacerVentaNodoDisController::class,'index'])->name('remitoND');

Route::resource('Hacer-remito-nodo-Distribuidor', HacerVentaNodoDisController::class)->names('remitoND-r');

//Ciclos
Route::resource('procesoCiclo', ProcesoCicloController::class)->names('proceso.ciclo');

Route::post('/crearCicloCargaTabla',[ProcesoCicloController::class,'getProcesoCiclo'])->name('crearCiclo');

Route::post('/cerrarCiclo',[ProcesoCicloController::class,'closeCiclo'])->name('cerrarCiclo');

Route::post('/pendienteCiclo',[ProcesoCicloController::class,'pendienteCiclo'])->name('pendienteCiclo');

Route::get('/modificarCicloBase/{procesoCiclo}',[PedidoCompraController::class,'editCicloBase'])->name('editCicloBase');
Route::put('/modificarCicloBase/{procesoCiclo}',[PedidoCompraController::class,'updateCicloBase'])->name('updateCicloBase');
// Route::post('/modificarCicloBase/{procesoCiclo}',[PedidoCompraController::class,'updateCicloBase'])->name('modificarCicloBase');

// Route::get('')

// Route::get('getProductInfo', [HacerVentaController::class, 'getProductInfo'])->name('getProductInfo');
Route::resource('panel/nodo_distribuidor', NodoDistribuidorController::class)->names('panel.nodo_distribuidor');

Route::resource('panel/promesas', Prov_prod_nodoController::class)->names('panel.promesas');
Route::resource('panel/promesas/prome2', Promesa2Controller::class)->names('panel.promesas.prome2');

Route::resource('panel/pedido_clientes', Pedido_clientesController::class)->names('panel.pedido_clientes');
Route::resource('panel/usuarios', UsuariosController::class)->names('panel.usuarios');




//Exportar a excel y PDF
Route::get('exportar-caja-excel', [CajaController::class, 'exportarCajaExcel'])->name('exportar-caja-excel');
Route::get('exportar-caja-pdf', [CajaController::class, 'exportarCajaPDF'])->name('exportar-caja-pdf');

Route::get('exportar-nodoBase-excel', [NodoBaseController::class, 'exportarNodoBaseExcel'])->name('exportar-nodoBase-excel');
Route::get('exportar-nodobase-pdf', [NodoBaseController::class, 'exportarNodoBasePDF'])->name('exportar-nodoBase-pdf');

Route::get('exportar-nodoDistribuidor-excel', [NodoDistribuidorController::class, 'exportarNodoDistribuidorExcel'])->name('exportar-nodoDistribuidor-excel');
Route::get('exportar-nodoDistribuidor-pdf', [NodoDistribuidorController::class, 'exportarNodoDistribuidorPDF'])->name('exportar-nodoDistribuidor-pdf');

Route::get('exportar-proveedore-excel', [ProveedorController::class, 'exportarProveedoreExcel'])->name('exportar-proveedore-excel');
Route::get('exportar-proveedore-pdf', [ProveedorController::class, 'exportarProveedorePDF'])->name('exportar-proveedore-pdf');

Route::get('exportar-producto-excel', [ProductoController::class, 'exportarProductoExcel'])->name('exportar-producto-excel');
Route::get('exportar-producto-pdf', [ProductoController::class, 'exportarProductoPDF'])->name('exportar-producto-pdf');

Route::get('exportar-prov_prod_nodo-excel', [Prov_prod_nodoController::class, 'exportarProv_prod_nodoExcel'])->name('exportar-prov_prod_nodo-excel');
Route::get('exportar-prov_prod_nodo-pdf', [Prov_prod_nodoController::class, 'exportarProv_prod_nodoPDF'])->name('exportar-prov_prod_nodo-pdf');

// Route::get('getInfoProd', [HacerVentaController::class, 'getProductInfo'])->name('getProductInfo');

//Pedido de Compra
Route::resource('pedidoCompra',PedidoCompraController::class)->names('pedido.compra');

Route::post('/pedidoCompra/crearPedidoCompra',[PedidoCompraController::class,'crearPedido'])->name('crearPedidoCompra');

Route::get('/EditarPedidoCompra/{fila}',[PedidoCompraController::class,'EditarPedidoCompra'])->name('EditarPedidoCompra');
Route::put('/EditarPedidoCompra/{consul}',[PedidoCompraController::class,'update'])->name('filaU');
 //antes era post

//Route::resource('panel/pedidoCompra', PedidoCompraController::class)->names('panel.pedidoCompra'); 