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
        Schema::create('unidades_medida', function (Blueprint $table) {
            $table->id(); // ID autoincremental
            $table->string('nombre', 50); // Nombre de la unidad de medida (ejemplo: "Kilogramos", "Litros")
            $table->string('abreviatura', 10)->nullable(); // Abreviatura (ejemplo: "kg", "L")
            $table->timestamps(); // created_at y updated_at
        });

        // Agregar la relación con productos
        Schema::table('productos', function (Blueprint $table) {
            $table->unsignedBigInteger('unidad_medida_id')->nullable()->after('imagen'); // Relación con unidades de medida
            $table->foreign('unidad_medida_id')->references('id')->on('unidades_medida')->onDelete('set null');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('productos', function (Blueprint $table) {
            $table->dropForeign(['unidad_medida_id']);
            $table->dropColumn('unidad_medida_id');
        });

        Schema::dropIfExists('unidades_medida');
    }
};
