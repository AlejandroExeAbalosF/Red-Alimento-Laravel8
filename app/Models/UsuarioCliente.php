<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class UsuarioCliente extends Model
{
    use HasFactory;

    protected $table='usuario_clientes';
    

    protected $fillable=[
        'nombre',
        'apellido',
        'email',
        'usuario',
        'password',
        'celular'
    ];
    
}
