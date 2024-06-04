<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class VentaNodoDistribuidor extends Model
{
    use HasFactory;

    protected $table='venta_nodo_distribuidors';
    

    protected $fillable=[
        'recaduacion_estimada',
        'recaduacion_nodo_distribuidor_producto',
        'recaduacion_nodo_base_producto'
    ];
    
}
