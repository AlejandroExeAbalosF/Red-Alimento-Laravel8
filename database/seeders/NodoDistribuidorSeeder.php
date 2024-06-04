<?php

namespace Database\Seeders;

use App\Models\nodo_base;
use App\Models\NodoBase;
use App\Models\NodoDistribuidor;
use Illuminate\Database\Seeder;

class NodoDistribuidorSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $nodoB=1;
        NodoDistribuidor::create([
            'nombre'=>'Vaquero',
            'nodo_base_id'=> $nodoB
        ]);
        NodoDistribuidor::create([
            'nombre'=>'Tres cerrito',
            'nodo_base_id'=> $nodoB
        ]);
        NodoDistribuidor::create([
            'nombre'=>'San lorenzo',
            'nodo_base_id'=> $nodoB
        ]);
        NodoDistribuidor::create([
            'nombre'=>'Metan',
            'nodo_base_id'=> 2,
        ]);
    
    }
}
