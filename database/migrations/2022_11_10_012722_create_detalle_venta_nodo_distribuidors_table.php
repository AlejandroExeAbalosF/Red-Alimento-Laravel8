<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateDetalleVentaNodoDistribuidorsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('detalle_venta_nodo_distribuidors', function (Blueprint $table) {
            $table->id();
            //$table->unsignedBigInteger('venta_nodo_id');
            //$table->foreign('venta_nodo_id')->references('id')->on('venta_nodo_distribuidors');

            //$table->unsignedBigInteger('stock_estado_general_id');
            //$table->foreign('stock_estado_general_id')->references('id')->on('stock_estado_generales');

            $table->string('ciclo');
            
            $table->decimal('recaduacion_estimada_total',10,2);//sin carne
            $table->decimal('recaduacion_nodo_base_total',10,2);//sumatoria de todos los productos
            $table->decimal('recaduacion_nodo_distribuidor_total',10,2);//sumatoria de todos los productos
            $table->dateTime('fecha');

            $table->decimal('saldo_pendiente_total');

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
        Schema::dropIfExists('detalle_venta_nodo_distribuidors');
    }
}
