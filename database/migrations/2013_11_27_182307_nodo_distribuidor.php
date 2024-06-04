<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class NodoDistribuidor extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        //
        Schema::create('nodo_distribuidors', function(Blueprint $table)
        {
            $table->id();

            $table->unsignedBigInteger('nodo_base_id');
            $table->foreign('nodo_base_id')->references('id')->on('nodo_bases');

            $table->string('nombre');
            $table->string('email')->nullable();
            $table->string('direccion')->nullable();
            $table->string('provincia')->nullable();
            $table->string('celular')->nullable();
            $table->string('zona')->nullable();
            
            
            

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
        Schema::dropIfExists('nodo_distribuidors');
    }
}
