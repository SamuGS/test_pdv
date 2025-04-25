<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Compras extends Model
{
    // MODELO DE COMPRAS    
    protected $fillable = [
        'fechaingreso',
        'idusuario',
        'proveedor_id',
        // total_compra, monto_pagado, estado, forma_pago quedan al default de la BD

    ];

    public function productos()
    {
        return $this->hasMany(Producto::class);
    }
    // Usuario que hizo la compra
    public function usuario()
    {
        return $this->belongsTo(User::class, 'idusuario');
    }

    // Proveedor relacionado
    public function proveedor()
    {
        return $this->belongsTo(Proveedores::class, 'proveedor_id');
    }
}
