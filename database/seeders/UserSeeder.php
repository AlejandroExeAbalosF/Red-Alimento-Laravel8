<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        //
        User::create([
            'name' => 'admin',
            'email' => 'admin@gmail.com',
            'password' => Hash::make('12345'),
            
            'nodo_base_id'=>'1',
        ])->assignRole('admin');
        User::create([
            'name' => 'vendedor1',
            'email' => 'vendedor1@gmail.com',
            'password' => Hash::make('12345'),
            'nodo_distribuidor_id'=> '1',//Vaquero
            'nodo_base_id'=>'1',//Salta
        ])->assignRole('vendedor');
        User::create([
            'name' => 'vendedor2',
            'email' => 'vendedor2@gmail.com',
            'password' => Hash::make('12345'),
            'nodo_distribuidor_id'=> '2',//Tres Cerrito
            'nodo_base_id'=>'1',//Salta
        ])->assignRole('vendedor');
        User::create([
            'name' => 'vendedor3',
            'email' => 'vendedor3@gmail.com',
            'password' => Hash::make('12345'),
            'nodo_distribuidor_id'=> '3',//Sab lorenzo
            'nodo_base_id'=>'1',//Salta
        ])->assignRole('vendedor');
        

        User::create([
            'name' => 'cliente',
            'email' => 'cliente@gmail.com',
            'password' => Hash::make('12345'),
            
        ])->assignRole('cliente');

        User::create([
            'name' => 'ale96j',
            'email' => 'alejandroexe96@gmail.com',
            'password' => Hash::make('12345'),
            
        ])->assignRole('cliente');
        User::create([
            'name' => 'celeste',
            'email' => 'cel@gmail.com',
            'password' => Hash::make('12345'),
            
        ])->assignRole('cliente');
        User::create([
            'name' => 'seba1',
            'email' => 'seba1@gmail.com',
            'password' => Hash::make('12345'),
            
        ])->assignRole('cliente');
    }
}
