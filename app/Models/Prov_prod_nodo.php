<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Prov_prod_nodo extends Model
{
    use HasFactory;
    protected $table='prov_prod_nodos';
    protected $fillable = [
        'nodo_base_id', 'nodo_distribuidor_id', 'producto_id', 'proveedor_id','fecha_limite_promesa',
        'stock', 'precio_x_cajon','kg_x_cajon',
        'merma', 'precio_x_kg', 'flete', 'precio_flete',
        'porcentaje_red', 'porcentaje_nodoD','precio_final',
        'precio_flete2','precio_final2', 
    ];

    public function nodobase()
    {
        return $this->belongsTo(NodoBase::class, 'nodo_base_id');
    }

    public function nodoDistribuidor()
    {
        return $this->belongsTo(NodoDistribuidor::class, 'nodo_distribuidor_id');
    }

    public function producto()
    {
        return $this->belongsTo(Producto::class, 'producto_id');
    }

    public function proveedor()
    {
        return $this->belongsTo(Proveedor::class, 'proveedor_id');
    }
}
