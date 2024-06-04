<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Compra extends Model
{
    use HasFactory;

    protected $table='compras';

    protected $fillable=[
        'id',
        'proveedor_id',
        'fecha_hora',
        'total_compra',
        'tipo_factura'
    ];

    public function proveedores()
    {
        return $this->belongsTo(Proveedores::class, 'proveedor_id');
    }
}
