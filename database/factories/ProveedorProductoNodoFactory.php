<?php

namespace Database\Factories;

use App\Models\NodoBase;
use App\Models\NodoDistribuidor;
use App\Models\Producto;
use App\Models\Proveedor;
use Illuminate\Database\Eloquent\Factories\Factory;

class ProveedorProductoNodoFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        $nodoB= NodoBase::inRandomOrder()->first();
        $nodoD= NodoDistribuidor::inRandomOrder()->first();
        $producto= Producto::inRandomOrder()->first();
        $proveedor= Proveedor::inRandomOrder()->first();
        return [
            'nodo_base_id'=>$nodoB,
            'nodo_distribuidor_id'=>$nodoD,
            'producto_id'=>$producto,
            'proveedor_id'=>$proveedor,

            'stock_promesa_unitario'=> $this->faker->numberBetween(30, 60),
            'unidad_unitario_promesa'=> $this->faker->randomElement(['kg']),
            'cantida_minima_venta'=> '1',

            'stock_promesa_conjunto'=> '1',
            'unidad_conjunto_promesa'=> $this->faker->randomElement(['Cajon','Unidad']),

            'redondeo'=> $this->faker->numberBetween(20, 100),

            
        ];
    }
}
