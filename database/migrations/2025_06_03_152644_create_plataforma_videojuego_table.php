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
        Schema::create('plataforma_videojuego', function (Blueprint $table) {
            $table->foreignId('plataforma_id')
                  ->constrained() // Asume 'plataformas' por convención
                  ->onDelete('cascade'); 

            // Define la clave foránea para la tabla 'videojuegos'
            $table->foreignId('videojuego_id')
                  ->constrained() // Asume 'videojuegos' por convención
                  ->onDelete('cascade');

            $table->primary(['plataforma_id', 'videojuego_id']);

        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('plataforma_videojuego');
    }
};
