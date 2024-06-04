<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class DetalleCompra extends Model
{
    use HasFactory;
    
    protected $fillable = ['Total', 'Total_de_pago ','usuario_id', 'nodo_distribuidor_id'];

    public function nodoDistribuidor()
    {
        return $this->belongsTo(NodoDistribuidor::class, 'nodo_distribuidor_id');
    }

    public function usuarios()
    {
        return $this->belongsTo(Usuarios::class, 'usuario_id');
    }
}
