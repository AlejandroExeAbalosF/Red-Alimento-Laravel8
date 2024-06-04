<?php

namespace Database\Seeders;

use App\Models\Ciclo;
use Illuminate\Database\Seeder;

class CicloSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Ciclo::create([
            'nombre'=>'1.Mayo.2022',
            'estado'=>'cerrado',
            'nodo_base_id'=>1,
            'nodo_distribuidor_id'=>1,
        ]);
        Ciclo::create([
            'nombre'=>'2.Mayo.2022',
            'estado'=>'pendiente',
            'nodo_base_id'=>1,
            'nodo_distribuidor_id'=>2,
        ]);
        Ciclo::create([
            'nombre'=>'1.Junio.2022',
            'estado'=>'cerrado',
            'nodo_base_id'=>2,
            'nodo_distribuidor_id'=>1,
        ]);
        
    }
}
