<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('compras', function (Blueprint $table) {
            $table->id(); // Crea el campo id auto incremental
            $table->timestamp('fechaingreso'); // Fecha de la compra
            $table->unsignedBigInteger('idusuario'); // ID del usuario que realiza la compra
            $table->unsignedBigInteger('proveedor_id'); // ID proveedor
            $table->decimal('total_compra', 12, 2)->default(0); // Total de la compra, inicializado en 0
            $table->decimal('monto_pagado', 12, 2)->default(0); // Monto ya pagado, inicializado en 0
            $table->boolean('estado')->default(0); // Estado de la compra: 0 - pendiente, 1 - cerrada
            $table->string('forma_pago')->nullable(); // Forma de pago, puede ser 'efectivo', 'transferencia', etc.
        
            // Relacionar con las tablas usuarios y proveedores (si existieran)
            $table->foreign('idusuario')->references('id')->on('users')->onDelete('cascade');
            $table->foreign('proveedor_id')->references('id')->on('proveedores')->onDelete('cascade');
        
            $table->timestamps();
        });
        
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('compras');
    }
};
