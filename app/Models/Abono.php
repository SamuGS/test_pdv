<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Abono extends Model
{
    //
    protected $fillable = ['venta_id', 'monto', 'fecha'];

    public function venta()
    {
        return $this->belongsTo(Venta::class);
    }
}
