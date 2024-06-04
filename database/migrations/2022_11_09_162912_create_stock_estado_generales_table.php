<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateStockEstadoGeneralesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('stock_estado_generales', function (Blueprint $table) {
            $table->id();

        //$table->unsignedBigInteger('proveedor_producto_nodo_id');
        //$table->foreign('proveedor_producto_nodo_id')->references('id')->on('proveedor_producto_nodos');
            
             $table->unsignedBigInteger('proveedor_producto_nodo_id');
            $table->foreign('proveedor_producto_nodo_id')->references('id')->on('prov_prod_nodos');
            
            $table->unsignedBigInteger('ciclo_id');
            $table->foreign('ciclo_id')->references('id')->on('ciclos');
            $table->string('estado_pedido_compra')->nullable();
            $table->date('realizado_pedido_compra')->nullable();
            $table->date('llegada_pedido_compra')->nullable();
            //campos donde esta el total de la sumatoria del producto pedido por el clientes
            $table->decimal('stock_pedido_menor',10,2)->nullable();
            $table->decimal('redondeo_pedido',10,2)->nullable();
            $table->char('unidad_menor')->nullable();
            $table->integer('stock_pedido_mayor')->nullable();
            $table->char('unidad_mayor')->nullable();
            $table->decimal('precio_compra_pedido_unitario',10,2)->nullable();//dato dado por el proveedor

            //campos del registro de productos recibidos del nodo base
            $table->decimal('nb_cantidad_pedido_recibido_menor',10,2)->nullable();
            $table->integer('nb_cantidad_pedido_recibido_mayor')->nullable();
            $table->string('nb_estado_pedido_recibido')->nullable();
            $table->date('nb_fecha_pedido_recibido')->nullable();
            //
            $table->decimal('nb_stock_sobrante_menor',10,2)->nullable();
            $table->decimal('nb_stock_sobrante_mayor',10,2)->nullable();
      
            $table->string('nb_estado_pedido')->nullable();

            $table->decimal('nb_monto_minimo',10,2)->nullable();//duda

            //campos del registro de productos recibidos del nodo distribuido
            $table->decimal('nd_cantidad_pedido_recibido_menor',10,2)->nullable();
            $table->integer('nd_cantidad_pedido_recibido_mayor')->nullable();
            $table->string('nd_estado_pedido_recibido')->nullable();//esperando-recibido-pendiente
            $table->date('nd_fecha_pedido_recibido')->nullable();
            //campos de stock para la venta total
            $table->decimal('nd_stock_publico_menor',10,2)->nullable();
            $table->decimal('nd_stock_publico_mayor',10,2)->nullable();

            //stock de los pedidos de los clientes total
            $table->decimal('nd_pedido_cliente_menor',10,2)->nullable();
            $table->decimal('nd_pedido_cliente_mayor',10,2)->nullable();
            $table->string('nd_estado_pedido')->nullable();//retirado-abandonado-pendiente/duda pendiente? 
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('stock_estado_generales');
    }
}
