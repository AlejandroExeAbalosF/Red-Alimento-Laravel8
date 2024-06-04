<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateDetalleComprasTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('detalle_compras', function (Blueprint $table) {
            $table->id();

            $table->unsignedBigInteger('compra_id');
            $table->foreign('compra_id')->references('id')->on('compras');
            
            $table->unsignedBigInteger('stock_estado_general_id');
            $table->foreign('stock_estado_general_id')->references('id')->on('stock_estado_generales');

            $table->integer('cantidad_producto')->nullable();
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
        Schema::dropIfExists('detalle_compras');
    }
}
