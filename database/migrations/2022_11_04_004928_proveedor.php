<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class Proveedor extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        
 Schema::create('proveedors', function(Blueprint $table)
 {
     $table->id();

     $table->string('nombre');
     $table->string('apellido')->nullable();
     $table->string('razon_social')->nullable();
     $table->string('direccion')->nullable();
     $table->string('provincia')->nullable();
     $table->string('region')->nullable();
     $table->string('email')->nullable();
     $table->string('celular')->nullable();
     $table->string('telefono')->nullable();
     $table->string('cuil')->nullable();

     $table->timestamps();

 });
}

public function down()
{
 //
 Schema::dropIfExists('proveedors');
}
}


