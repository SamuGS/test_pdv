<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateProductosTable extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('productos', function (Blueprint $table) {
            $table->id(); // ID autoincremental
            $table->string('nombre', 100); // Nombre del producto
            $table->text('descripcion')->nullable(); // Descripción del producto
            $table->decimal('precio', 10, 2); // Precio del producto
            $table->integer('stock'); // Cantidad en stock
            $table->boolean('estado')->default(1); // Estado (activo/inactivo)
            $table->string('imagen')->nullable(); // Ruta de la imagen del producto

            // Relación con la tabla categorias
            $table->unsignedBigInteger('categoria_id'); // ID de la categoría
            $table->foreign('categoria_id')->references('id')->on('categorias')->onDelete('cascade');

            // Relación con la tabla proveedores
            $table->unsignedBigInteger('proveedor_id'); // ID del proveedor
            $table->foreign('proveedor_id')->references('id')->on('proveedores')->onDelete('cascade');

            $table->timestamps(); // created_at y updated_at
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('productos');
    }
}
