<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\Proveedores;

class Producto extends Model
{
    use HasFactory;

    protected $fillable = [
        'nombre',
        'descripcion',
        'precio',
        'stock',
        'categoria_id',
        'proveedor_id',
        'estado',
        'imagen', // Agregar el campo imagen
        'unidad_medida_id', // Agregar el campo de unidad de medida
    ];

    // Relación con la categoría
    public function categoria()
    {
        return $this->belongsTo(Categoria::class);
    }

    // Relación con el proveedor
    public function proveedor()
    {
        return $this->belongsTo(Proveedores::class);
    }

    // Relación con la unidad de medida
    public function unidadMedida()
    {
        return $this->belongsTo(UnidadMedida::class);
    }
}
