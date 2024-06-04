<?php

namespace Database\Factories;

use App\Models\PedidoCliente;
use App\Models\ProveedorProductoNodo;
use Illuminate\Database\Eloquent\Factories\Factory;

class DetallePedidoClienteFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        $pedidoC=PedidoCliente::inRandomOrder()->first();
        $ppn=ProveedorProductoNodo::inRandomOrder()->first();
        return [
            'pedido_cliente_id' => $pedidoC,
            'proveedor_producto_nodo_id' => $ppn,

            'cantidad_producto'=>$this->faker->numberBetween(1, 10),
            'precio_unitario'=>$this->faker->randomFloat(2,20,40),
            'sub_total'=>$this->faker->randomFloat(2,40,100),
        ];
    }
}
