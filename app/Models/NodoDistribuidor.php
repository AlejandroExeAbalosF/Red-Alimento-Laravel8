<?php

namespace App\Models;


use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class NodoDistribuidor extends Model
{
    use HasFactory;

    protected $fillable = ['nombre', 'email', 'direccion', 'provincia', 'celular','zona', 'nodo_base_id'];

    public function nodoBase()
    {
        return $this->belongsTo(NodoBase::class, 'nodo_base_id');
    }
}
