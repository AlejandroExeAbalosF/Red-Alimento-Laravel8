<?php

namespace Database\Seeders;

use App\Models\Categoria;
use Illuminate\Database\Seeder;

class CategoriaSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        
        Categoria::create([
            'nombre'=>'Verduras',
        ]);
        Categoria::create([
            'nombre'=>'Carne',
        ]);
        Categoria::create([
            'nombre'=>'Fruta',
        ]);
      
    }
}
