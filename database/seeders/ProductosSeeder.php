<?php

namespace Database\Seeders;

use App\Models\Producto;
use Illuminate\Database\Seeder;

class ProductosSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Producto::create([
            'nombre'=>'Coliglor',
            'categoria_id'=>1,
        ]);
        Producto::create([
            'nombre'=>'Repollo',
            'categoria_id'=>1,
        ]);
        Producto::create([
            'nombre'=>'Duraznos',
            'categoria_id'=>3,
        ]);
        Producto::create([
            'nombre'=>'Pollo',
            'categoria_id'=>2,
        ]);
    }
}
