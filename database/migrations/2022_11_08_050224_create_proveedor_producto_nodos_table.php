<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateProveedorProductoNodosTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('proveedor_producto_nodos', function (Blueprint $table) {
            $table->id();
            
            $table->unsignedBigInteger('nodo_base_id');
            $table->foreign('nodo_base_id')->references('id')->on('nodo_bases');

            $table->unsignedBigInteger('nodo_distribuidor_id');
            $table->foreign('nodo_distribuidor_id')->references('id')->on('nodo_distribuidors');

            $table->unsignedBigInteger('producto_id');
            $table->foreign('producto_id')->references('id')->on('productos');

            $table->unsignedBigInteger('proveedor_id');
            $table->foreign('proveedor_id')->references('id')->on('proveedors');

            $table->decimal('stock_promesa_unitario',10,2);
            $table->decimal('stock_pedido_unitario',10,2)->nullable();//las cantidades que se pidieron de esa promesa
            $table->string('unidad_unitario_promesa');
            $table->decimal('precio_unitario_promesa',10,2)->nullable();
            $table->integer('stock_promesa_conjunto');
            $table->string('unidad_conjunto_promesa');
            $table->decimal('precio_conjunto_promesa',10,2)->nullable();
            $table->date('fecha_promesa')->nullable();
            $table->date('fecha_limite_promesa')->nullable();

            $table->decimal('cantida_minima_venta',10,2)->nullable();
            $table->char('unidad_venta')->nullable();
            $table->decimal('precio',10,2)->nullable();
            $table->decimal('merma')->nullable();
            $table->decimal('flete',10,2)->nullable();
            $table->decimal('precio_flete',10,2)->nullable();
            $table->integer('porcetaje_red')->nullable();
            $table->integer('porcetaje_nodo_d')->nullable();
            $table->decimal('precio_final',10,2)->nullable();
            $table->integer('redondeo');

            $table->decimal('precio_flete2',10,2)->nullable();
            $table->decimal('precio_porcentaje',10,2)->nullable();
            $table->integer('redondeo2')->nullable();

            
            
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
        Schema::dropIfExists('proveedor_producto_nodos');
    }
}
