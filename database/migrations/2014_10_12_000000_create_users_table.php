<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('users', function (Blueprint $table) {
            $table->id();
            $table->string('name');
            $table->string('apellido')->nullable();
            $table->integer('dni')->nullable();
            $table->string('usuario')->nullable();
            $table->string('celular')->nullable();
            $table->string('direccion')->nullable();
            $table->date('fecha_nacimiento')->nullable();
            $table->date('fehca_alta')->nullable();
            $table->date('fecha_baja')->nullable();
            $table->string('estado')->nullable();

            $table->unsignedBigInteger('nodo_distribuidor_id')->nullable();
            $table->foreign('nodo_distribuidor_id')->references('id')->on('nodo_distribuidors');   
            
            $table->unsignedBigInteger('nodo_base_id')->nullable();
            $table->foreign('nodo_base_id')->references('id')->on('nodo_bases');

            $table->string('email')->unique();
            $table->timestamp('email_verified_at')->nullable();
            $table->string('password');
            $table->rememberToken();
            $table->foreignId('current_team_id')->nullable();
            $table->string('profile_photo_path', 2048)->nullable();
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
        Schema::dropIfExists('users');
    }
};
