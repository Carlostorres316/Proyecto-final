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
        Schema::create('cursos', function (Blueprint $table) {
            $table->id();
            //Ondelete cascade para eliminar los cursos de un instructor si este es eliminado
            $table->foreignId('user_id')->constrained('users')->onDelete('cascade');
            $table->foreignId('subcategoria_id')->constrained('subcategorias')->onDelete('cascade');
            $table->string('titulo');
            $table->text('descripcion');
            $table->decimal('precio', 10, 2)->default(0.00)->nullable(); //Precio por defecto 0 para cursos gratuitos
            $table->enum('nivel', ['principiante', 'intermedio', 'avanzado'])->default('principiante');
            $table->date('fecha_creacion');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('cursos');
    }
};