<?php

namespace Database\Seeders;

use App\Models\NodoBase;
use Illuminate\Database\Seeder;

class NodoBaseSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        
        NodoBase::create([
            'nombre'=>'Salta', 
        ]);
        NodoBase::create([
            'nombre'=>'Jujuy', 
        ]);
    
    }
}
