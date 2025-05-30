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
        Schema::create('categorias', function (Blueprint $table) {
            $table->id();
            $table->string('nombre');
            $table->timestamps();
        });
        // Insertar categorías base
        DB::table('categorias')->insert([
            ['nombre' => 'Debate', 'created_at' => now(), 'updated_at' => now()],
            ['nombre' => 'Charla', 'created_at' => now(), 'updated_at' => now()],
            ['nombre' => 'Chambre', 'created_at' => now(), 'updated_at' => now()],
            ['nombre' => 'Otros', 'created_at' => now(), 'updated_at' => now()],
            ['nombre' => 'Videojuegos', 'created_at' => now(), 'updated_at' => now()],
            ['nombre' => 'Música', 'created_at' => now(), 'updated_at' => now()],
            ['nombre' => 'Deportes', 'created_at' => now(), 'updated_at' => now()],
            ['nombre' => 'Dudas', 'created_at' => now(), 'updated_at' => now()],
            ['nombre' => 'Tecnología', 'created_at' => now(), 'updated_at' => now()],
            ['nombre' => 'Entretenimiento', 'created_at' => now(), 'updated_at' => now()],
            ['nombre' => 'Actualidad', 'created_at' => now(), 'updated_at' => now()],
            ['nombre' => 'Otros temas', 'created_at' => now(), 'updated_at' => now()],
        ]);
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('categorias');
    }
};
