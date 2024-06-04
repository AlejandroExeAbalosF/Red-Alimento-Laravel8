<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class ProveedorProductoNodos extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('prov_prod_nodos', function (Blueprint $table)
        {
            $table->id();

            $table->unsignedBigInteger('nodo_base_id');
            $table->foreign('nodo_base_id')->references('id')->on('nodo_bases');

            $table->unsignedBigInteger('nodo_distribuidor_id');
            $table->foreign('nodo_distribuidor_id')->references('id')->on('nodo_distribuidors');

            $table->unsignedBigInteger('producto_id');
            $table->foreign('producto_id')->references('id')->on('productos');

            $table->unsignedBigInteger('proveedor_id');
            $table->foreign('proveedor_id')->references('id')->on('proveedors');

            // $table->decimal('stock_promesa_unitario', 10, 2)->nullable();
            // $table->decimal('unidad_unitario_promesa', 10, 2)->nullable();
            // $table->decimal('precio_unitario_promesa', 10, 2)->nullable();
            // $table->decimal('stock_promesa_conjunto', 10, 2)->nullable();
            // $table->decimal('unidad_conjunto_promesa', 10, 2)->nullable();
            // $table->decimal('precio_conjunto_promesa', 10, 2)->nullable();
            // $table->date('fecha_promesa');
            // $table->date('fecha_limite_promesa');
            // $table->decimal('cantidad_minima_venta', 10, 2)->nullable();
            // $table->string('unidad_venta')->nullable();
            // $table->decimal('precio', 10, 2)->nullable();
            // $table->decimal('merma', 10,2)->nullable();
            // $table->decimal('flete', 10,2)->nullable();
            // $table->decimal('precio_flete', 10,2)->nullable();
            // $table->decimal('porcentaje_red', 10,2)->nullable();
            // $table->decimal('porcentaje_nodo_d', 10,2)->nullable();
            // $table->decimal('precio_final', 10,2);
            // $table->decimal('redondeo', 10,2);
            // $table->decimal('precio_flete2', 10,2)->nullable();
            // $table->decimal('precio_porcentaje', 10,2)->nullable();
            // $table->decimal('redondeo2', 10,2)->nullable();       
            
            
            $table->date('fecha_limite_promesa');
            $table->integer('stock')->nullable();//Unida Mayor Promesa
            $table->decimal('precio_x_cajon', 10, 2)->nullable();//Precio por unidad mayor
            $table->decimal('kg_x_cajon', 10, 2)->nullable();//Unida Menor Promesa
            $table->decimal('merma', 10,2)->nullable();
            $table->decimal('precio_x_kg', 10,2);//Precio por unidad menor
            $table->decimal('flete', 10,2)->nullable();
            $table->decimal('precio_flete', 10,2)->nullable();
            $table->decimal('porcentaje_red', 10,2)->nullable();
            $table->decimal('porcentaje_nodoD', 10,2)->nullable();
            $table->decimal('precio_final', 10,2);//precio final por unidad menor

            $table->decimal('precio_flete2', 10,2)->nullable();
            $table->decimal('precio_final2', 10,2)->nullable();//precio final por unidad mayor

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
        Schema::dropIfExists('prov_prod_nodos');
    }
}
