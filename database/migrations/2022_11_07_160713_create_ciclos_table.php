<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateCiclosTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('ciclos', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('nodo_base_id')->nullable();
            $table->foreign('nodo_base_id')->references('id')->on('nodo_bases');

            $table->unsignedBigInteger('nodo_distribuidor_id')->nullable();
            $table->foreign('nodo_distribuidor_id')->references('id')->on('nodo_distribuidors');

            $table->string('nombre');
            $table->date('fecha_inicio')->nullable();
            $table->date('fecha_baja')->nullable();
            $table->dateTime('fecha_limite')->nullable();
            $table->string('estado');
            
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
        Schema::dropIfExists('ciclos');
    }
}
