<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Clientes extends Model
{
    //
    protected $fillable = [
        'nombre',
        'telefono',  
        'direccion',    
        'estado',    
    ];
}
