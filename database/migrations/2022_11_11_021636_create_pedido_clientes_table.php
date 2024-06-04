<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreatePedidoClientesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('pedido_clientes', function (Blueprint $table) {
            $table->id();
            

            $table->unsignedBigInteger('usuario_id');
            $table->foreign('usuario_id')->references('id')->on('users');
            
            $table->unsignedBigInteger('nodo_distribuidor_id');
            $table->foreign('nodo_distribuidor_id')->references('id')->on('nodo_distribuidors');

            $table->string('estado')->nullable();
            //$table->dateTime('fecha_hora')->nullable();
            $table->decimal('total',10,2)->nullable();
            $table->string('tipo_pago')->nullable();

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
        Schema::dropIfExists('pedido_clientes');
    }
}
