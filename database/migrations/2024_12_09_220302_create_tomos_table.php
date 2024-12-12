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
        Schema::create('tomos', function (Blueprint $table) {
            $table->id();
            $table->integer('numero_tomo')->unique();
            $table->string('titulo',255);
            $table->text('capitulos_incluidos');
            $table->date('fecha_publicacion');
            $table->text('portada');
            $table->text('sinopsis');
            $table->boolean("eliminado")->default(0);
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('tomos');
    }
};
