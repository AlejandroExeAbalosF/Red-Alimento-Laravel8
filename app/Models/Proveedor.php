<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Proveedor extends Model
{
    use HasFactory;
    protected $fillable=[
        'nombre',
        'apellido',
        'razon_social',
        'direccion',
        'provincia',
        // 'region',
        'email',
        'celular',
        'telefono',
        'cuil',
    ];

}
