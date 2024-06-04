<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        // \App\Models\User::factory(10)->create();
        $this->call(NodoBaseSeeder::class);
        $this->call(CategoriaSeeder::class);
        $this->call(ProductosSeeder::class);
        $this->call(ProveedorSeeder::class);
        $this->call(NodoDistribuidorSeeder::class);
        $this->call(RolSeeder::class); 
        $this->call(UserSeeder::class);
        // $this->call(CicloSeeder::class);

        // Producto::factory(20)->create();
        // Proveedor::factory(10)->create();
        // ProveedorProductoNodo::factory(15)->create();
        // StockEstadoGeneral::factory(10)->create();
        
        
        // PedidoCliente::factory(10)->create();
        // DetallePedidoCliente::factory(10)->create();
    }
}
