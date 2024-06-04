<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateDetallePedidoClientesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('detalle_pedido_clientes', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('pedido_cliente_id');
            $table->foreign('pedido_cliente_id')->references('id')->on('pedido_clientes');
            $table->unsignedBigInteger('stock_estado_general_id');
            $table->foreign('stock_estado_general_id')->references('id')->on('stock_estado_generales');

            $table->string('estado')->nullable();

            $table->integer('cantidad_producto')->nullable();
            $table->integer('cantidad_producto_disponible')->nullable();
            $table->decimal('precio_unitario',10,2)->nullable();
            $table->decimal('sub_total',10,2)->nullable();
            
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
        Schema::dropIfExists('detalle_pedido_clientes');
    }
}
