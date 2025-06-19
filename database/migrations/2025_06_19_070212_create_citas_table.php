<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('citas', function (Blueprint $table) {
            $table->id();
            $table->foreignId('tramite_id')
                  ->constrained('tramites')
                  ->onDelete('cascade');
            $table->dateTime('fecha_hora');
            $table->string('ubicacion');
            $table->enum('estado', ['pendiente', 'confirmada', 'cancelada'])
                  ->default('pendiente');
            $table->text('observaciones')->nullable();
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('citas');
    }
};