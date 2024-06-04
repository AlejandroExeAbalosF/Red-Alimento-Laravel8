<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Spatie\Permission\Models\Permission;
use Spatie\Permission\Models\Role;

class RolSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        // Roles
        $rol_admin = Role::create(['name' => 'admin']);
        $rol_vendedor = Role::create(['name' => 'vendedor']);
        $rol_cliente = Role::create(['name' => 'cliente']);
        // Permisos para cada Rol

        Permission::create(['name' => 'lista_usuarios'])->assignRole($rol_admin);
      
        Permission::create(['name' => 'indexPublic'])->assignRole($rol_cliente);

        // Permission::create(['name' => 'lista_productos'])->assignRole($rol_vendedor);
        // Permission::create(['name' => 'lista_productos'])->assignRole($rol_admin);

        //Permission::create(['name' => 'hacer_venta'])->assignRole($rol_admin);
        //Permission::create(['name' => 'hacer_venta'])->assignRole($rol_vendedor);
        //Permission::create(['name' => 'hacer_venta'])->assignRole($rol_cliente);

        // Permission::create(['name' => 'lista_compras'])->assignRole($rol_vendedor);
        // Permission::create(['name' => 'lista_compras'])->assignRole($rol_admin);

        // Permission::create(['name' => 'lista_productos'])->syncRolese([$rol_vendedor, $rol_admin]);
         Permission::create(['name' => 'hacer_venta'])->syncRoles([$rol_admin,$rol_vendedor]);
         Permission::create(['name' => 'lista_compras'])->syncRoles([$rol_vendedor, $rol_admin]);
        
        //Permission::create(['name' => 'lista_pagos'])->syncRoles([$rol_vendedor, $rol_cliente]);
    }
}
