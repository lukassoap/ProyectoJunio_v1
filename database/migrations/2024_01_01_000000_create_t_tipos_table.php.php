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
        Schema::create('t_tipos', function (Blueprint $table) {
            $table->id();
            $table->string('nombre')->unique(); // Nombre del tipo de trámite
            $table->text('descripcion')->nullable(); // Descripción del tipo de trámite
            $table->decimal('costo', 8, 2)->default(0.00); // Costo del tipo de trámite, con dos decimales
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('t_tipos');
    }
};
