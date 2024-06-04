<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateStockNodobTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('stock_nodob', function (Blueprint $table) {
            $table->id();

            $table->unsignedBigInteger('nodo_base_id')->nullable();
            $table->foreign('nodo_base_id')->references('id')->on('nodo_bases');

            $table->string('nombre');
            $table->string('estado');
            
            $table->decimal('nb_cantidad_pedido_total_menor',10,2)->nullable();
            $table->integer('nb_cantidad_pedido_total_mayor')->nullable();

            $table->decimal('nb_cantidad_pedido_recibido_menor',10,2)->nullable();
            $table->integer('nb_cantidad_pedido_recibido_mayor')->nullable();
            $table->string('nb_estado_pedido_recibido')->nullable();
            $table->date('nb_fecha_pedido_recibido')->nullable();
            //
            $table->decimal('nb_stock_sobrante_menor',10,2)->nullable();
            $table->decimal('nb_stock_sobrante_mayor',10,2)->nullable();
      
            $table->string('nb_estado_pedido')->nullable();

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
        Schema::dropIfExists('stock_nodob');
    }
}
