<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class HistorialPedidoController extends Controller
{
    public function historial()
    {
        $pa="hola mundo";
        return view('panel.cliente.HistorialP', compact('pa'));
    }
    public function pedido()
    {
        $p="hola mundo";
        return view('panel.cliente.pedido', compact('p'));
    }
}
