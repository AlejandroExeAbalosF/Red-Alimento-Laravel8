<?php

use App\Models\User;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\HacerPedidoController;

use App\Mail\correoMailable;
use Illuminate\Support\Facades\Mail ;
/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

//Route::get('/',[HacerPedidoController::class,'index'] )->name('index');


Route::middleware([
    'auth:sanctum',
    config('jetstream.auth_session'),
    'verified'
])->group(function () {
    Route::get('/dashboard', function () {
        return view('dashboard');
    })->name('dashboard');
});
//Route::get('/');

//rutas del carrito
Route::get('/', [HacerPedidoController::class, 'index'])->name('indexPublic');
Route::get('/cart', [HacerPedidoController::class,'cart'])->name('cart.index');
Route::post('/add', [HacerPedidoController::class,'add'])->name('cart.store');
Route::post('/update', [HacerPedidoController::class,'update'])->name('cart.update');
Route::post('/remove', [HacerPedidoController::class, 'remove'])->name('cart.remove');
Route::post('/clear', [HacerPedidoController::class, 'clear'])->name('cart.clear');

Route::post('/guardarPedido', [HacerPedidoController::class, 'guardarPedido'])->name('guardarp');

//para ver si el usuario esta registrado
// route::get('/usuarioRegistrado',function(){
//     $usuario= User::where('id','3')->exists();
//         if($usuario == null){
//             return "usuario no registrado";
//         }else{
//             return view('index', compact('usuario')); 
//         }
// });

//categorias
Route::post('/cart', [HacerPedidoController::class,'categoria'])->name('cart.categoria');


Route::get('/categoria', [HacerPedidoController::class, 'categoria'])->name('categoria');

route::post('/productoCategoria', [HacerPedidoController::class, 'productoCategoria']);

//ruta email
Route::get('pedidos',function(){
    
    $correo= new correoMailable;
    mail::to('braiansalva2001@gmail.com')->send($correo);
    
    return "mensaje enviado";
});

//proceso de pedido de compra al proveedor
    


