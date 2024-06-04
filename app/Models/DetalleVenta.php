<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class DetalleVenta extends Model
{
    use HasFactory;

    protected $table='detalle_ventas';
    

    protected $fillable=[
        'ventas_id',
        'stock_estado_general_id',
        'cantidad_producto',
        'precio_unitario',
        'sub_total'
    ];
}
