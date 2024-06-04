<?php

namespace Database\Factories;

use App\Models\NodoDistribuidor;
use App\Models\UsuarioCliente;
use Illuminate\Database\Eloquent\Factories\Factory;

class PedidoClienteFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        $userC= UsuarioCliente::inRandomOrder()->first();
        $nodoD= NodoDistribuidor::inRandomOrder()->first();
        return [
            'usuario_cliente_id'=>$userC,
            'nodo_distribuidor_id'=>$nodoD,
            
            'fecha_hora'=>$this->faker->dateTimeBetween('-1 week', '+1 week'),
            'total'=>$this->faker->randomFloat(2, 20, 200),
        ];
    }
}
