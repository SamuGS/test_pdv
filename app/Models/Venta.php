<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Venta extends Model
{
    use HasFactory;

    protected $fillable = [
        'cliente_id',
        'correlativo',
        'total',
        'tipo_pago',
        'monto_pagado',
        'saldo_pendiente',
        'estado',
        'metodo_pago'
    ];

    // Relación con el cliente
    public function clientes()
    {
        return $this->belongsTo(Clientes::class, 'cliente_id');
    }

    // Relación con los productos
    public function productos()
    {
        return $this->belongsToMany(Producto::class)->withPivot('cantidad', 'subtotal');
    }
}
