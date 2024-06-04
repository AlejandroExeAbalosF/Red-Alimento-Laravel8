<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Ciclo extends Model
{
    use HasFactory;
    
    protected $table='ciclos';

    protected $fillable=[
        'nodo_base_id',
        'nodo_distribuidor_id',
        
        'nombre',
        'fecha_inicio',
        'fecha_baja',
        'fecha_limite',
        'estado',
    ];
}
