<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ProveedorProductoNodo extends Model
{
    use HasFactory;

    protected $table = 'proveedor_producto_nodos';

    protected $fillable = [
        'stock_promesa_unitario',
        'unidad_unitario_promesa',
        'precio_unitario_promesa',
        'stock_promesa_conjunto',
        'unidad_conjunto_promesa',
        'precio_conjunto_promesa',
        'fecha_promesa',
        'fecha_limite_promesa',

        'cantida_minima_venta',
        'unidad_venta',
        'precio',
        'merma',
        'flete',
        'precio_flete',
        'porcetaje_red',
        'porcetaje_nodo_d',
        'precio_final',
        'redondeo',

        'precio_flete2',
        'precio_porcentaje',
        'redondeo2'
    ];

    public function producto(){
        return $this->belongsTo(Producto::class,'producto_id');
    }
    public function proveedor(){
        return $this->belongsTo(Proveedor::class,'proveedor_id');
    }
    public function nodoBase(){
        return $this->belongsTo(NodoBase::class,'nodo_base_id');
    }
    public function nodoDistribuidor(){
        return $this->belongsTo(NodoDistribuidor::class,'nodo_distribuidor_id');
    }
}
