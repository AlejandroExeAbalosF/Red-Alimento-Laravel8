<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class PedidoCliente extends Model
{
    use HasFactory;
    protected $table='pedido_clientes';

    protected $fillable=[
        
        'usuario_id',
        'nodo_distribuidor_id',
        'estado',
        'total',
        'tipo_pago',
    ];
}
