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
        Schema::create('detalle_compras', function (Blueprint $table) {
            $table->id();

            // Relación con la compra
            $table->unsignedBigInteger('id_compra');
            $table->foreign('id_compra')->references('id')->on('compras')->onDelete('cascade');

            // Relación con el producto
            $table->unsignedBigInteger('id_producto');
            $table->foreign('id_producto')->references('id')->on('productos')->onDelete('cascade');

            // Precio de compra por unidad
            $table->decimal('precio_unitario', 10, 2);

            // Cantidad en unidad de compra
            $table->integer('cantidad');

            // Total por producto
            $table->decimal('total', 10, 2);

            // Unidad con la que se compra (java, caja, libra, etc.)
            $table->string('unidad_compra');

            // Conversión a unidad de venta (ej: 1 java = 50 libras)
            $table->decimal('conversion_venta', 10, 2)->nullable();

            // Unidad de venta (libra, onza, unidad, etc.)
            $table->string('unidad_venta')->nullable();

            $table->timestamps();  
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('detalle_compras');
    }
};
