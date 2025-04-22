<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Categoria extends Model
{
    // MODELO DE CATEGORIA    
    protected $fillable = [
        'nombre',
        'estado',               
    ];

    public function productos()
    {
        return $this->hasMany(Producto::class);
    }
}
