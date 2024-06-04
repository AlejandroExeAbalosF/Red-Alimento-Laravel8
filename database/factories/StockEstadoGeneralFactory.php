<?php

namespace Database\Factories;

use App\Models\Ciclo;
use App\Models\ProveedorProductoNodo;
use Illuminate\Database\Eloquent\Factories\Factory;

class StockEstadoGeneralFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {   
        $provProdNodo=ProveedorProductoNodo::inRandomOrder()->first();
        $ciclo=Ciclo::inRandomOrder()->first();
        return [
            'ciclo_id'=>$ciclo,
            'proveedor_producto_nodo_id'=> $provProdNodo,
            
            'stock_pedido_menor'=>$this->faker->numberBetween(5, 20),
            'unidad_menor'=> $this->faker->randomElement(['kg']),
            'precio_compra_pedido_unitario'=>$this->faker->randomFloat(2,20,40),
            'nb_cantidad_pedido_recibido_menor'=>$this->faker->numberBetween(0, 20),
        
            
            //nd
            'nd_cantidad_pedido_recibido_menor'=> $this->faker->numberBetween(30, 60),
      
            'nd_stock_publico_menor'=> $this->faker->numberBetween(0, 40),
       
            'nd_pedido_cliente_menor'=> $this->faker->numberBetween(40, 60),
      
            'nd_estado_pedido'=>'recibido'

        ];
    }
}
