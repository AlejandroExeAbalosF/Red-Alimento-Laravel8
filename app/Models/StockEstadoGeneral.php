<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class StockEstadoGeneral extends Model
{
    use HasFactory;
    protected $table = 'stock_estado_generales';

    protected $fillable = [
        'proveedor_producto_nodo_id',
        'ciclo_id',
        
        'estado_pedido_compra',

        'stock_pedido_menor',
        'redondeo_pedido',
        'unidad_menor',
        'stock_pedido_mayor',
        'unidad_mayor',
        'precio_compra_pedido_unitario',

        'nb_cantidad_pedido_recibido_menor',
        'nb_cantidad_pedido_recibido_mayor',
        'nb_estado_pedido_recibido',
        'nb_fecha_pedido_recibido',
        'nb_stock_sobrante_menor',
        'nb_stock_sobrante_mayor',
        'nb_estado_pedido',
        'nb_monto_minimo',

        'nd_cantidad_pedido_recibido_menor',
        'nd_cantidad_pedido_recibido_mayor',

        'nd_estado_pedido_recibido',
        'nd_fecha_pedido_recibido',
        'nd_stock_publico_menor',
        'nd_stock_publico_mayor',

        'nd_pedido_cliente_menor',
        'nd_pedido_cliente_mayor',
        'nd_estado_pedido',
        
    ];
}

