<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class DetallePedidoCliente extends Model
{
    use HasFactory;
    protected $table='detalle_pedido_clientes';

    protected $fillable=[
        'pedido_cliente_id',
        'stock_estado_general_id',
        'cantidad_producto',
        'precio_unitario',
        'sub_total',
        'estado',
        'cantidad_producto_disponible',
    ];
}
