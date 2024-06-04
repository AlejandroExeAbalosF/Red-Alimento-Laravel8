<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class Arqueocaja extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        //
        Schema::create('arqueo_cajas', function(Blueprint $table)
        {
            $table->id();

            $table->decimal('monto_inicial', 10, 2)->default(0);
            $table->decimal('total_ventas', 10, 2)->default(0);
            $table->decimal('total_compras', 10, 2)->default(0);
            $table->decimal('saldo', 10, 2)->default(0);
            $table->decimal('faltante', 10, 2)->default(0);
            $table->decimal('sobrante', 10, 2)->default(0);

            $table->unsignedBigInteger('caja_id');
            $table->foreign('caja_id')->references('id')->on('cajas');
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
        Schema::dropIfExists('arqueo_cajas');
    }
}
