<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class Caja extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        //
        Schema::create('cajas', function(Blueprint $table)
        {
            $table->id();

            $table->date('fecha_hora_cierre')->nullable();
            $table->decimal('monto_inicial', 10, 2)->default(0);
            $table->decimal('total_ventas', 10, 2)->default(0);
            $table->decimal('total_compras', 10, 2)->default(0);
            $table->decimal('saldo_contable', 10, 2)->default(0);
            $table->decimal('faltante', 10, 2)->default(0);
            $table->decimal('sobrante', 10, 2)->default(0);
            $table->decimal('monto_final', 10, 2)->default(0);
            $table->string('estado')->default(1);
            $table->unsignedBigInteger('user_id');
            $table->foreign('user_id')->references('id')->on('users');

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
        //
        Schema::dropIfExists('cajas');
    }
}
