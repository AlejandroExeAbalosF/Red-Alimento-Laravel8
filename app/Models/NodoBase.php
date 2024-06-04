<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class NodoBase extends Model
{
    use HasFactory;

    protected $fillable = ['nombre', 'email', 'direccion', 'provincia', 'celular'];
}
