<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateVentaNodoDistribuidorsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('venta_nodo_distribuidors', function (Blueprint $table) {
            $table->id();
          // $table->unsignedBigInteger('nodo_distribuidor_id');
           //$table->foreign('nodo_distribuidor_id')->references('id')->on('nodo_distribuidors');

            $table->decimal('recaduacion_estimada',10,2)->nullable();
            $table->decimal('sub',10,2)->nullable();//cantida de producto por precio del producto
            $table->decimal('recaduacion_nodo_distribuidor_producto',10,2)->nullable();//Valor a rendir
            $table->decimal('recaduacion_nodo_base_producto',10,2)->nullable();//subTotal

            

            $table->decimal('saldo_pendiente',10,2);

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
        Schema::dropIfExists('venta_nodo_distribuidors');
    }
}
