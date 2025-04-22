<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Proveedores extends Model
{
    // MODELO DE PROVEEDOR   
    protected $fillable = [
        'nombre',
        'direccion',  
        'telefono',   
        'email',  
        'estado',    
    ];

    public function productos()
    {
        return $this->hasMany(Producto::class);
    }
}


