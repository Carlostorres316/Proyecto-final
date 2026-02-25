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
            $table->id();
            $table->foreignId('user_id')->constrained('users')->onDelete('cascade');
            $table->foreignId('curso_id')->constrained('cursos')->onDelete('cascade');
            $table->decimal('precio_pagado', 10, 2);
            $table->enum('metodo_pago', ['tarjeta', 'paypal', 'transferencia'])->default('tarjeta');
            $table->enum('estado_pago', ['pendiente', 'completado', 'cancelado'])->default('pendiente');

            //Un estudiante no puede comprar el mismo curso más de una vez
            $table->unique(['user_id', 'curso_id']);
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
