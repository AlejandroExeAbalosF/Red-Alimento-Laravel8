<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Venta extends Model
{
    use HasFactory;

    protected $table='ventas';
    

    protected $fillable=[
        'usuario_cliente_id',
        'fecha_hora',
        'total_venta',
        'tipo_factura'
    ];
}
