<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Caja extends Model
{
    use HasFactory;

    protected $fillable = ['monto_inicial','user_id'];

    public function usuario()
    {
        return $this->belongsTo(User::class, 'user_id');
    }
        
}
