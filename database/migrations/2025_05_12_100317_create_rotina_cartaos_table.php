<?php
use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    public function up(): void
    {
        Schema::create('rotina_cartaos', function (Blueprint $table) {
            $table->id();
            $table->foreignId('rotina_id')->constrained('rotinas')->cascadeOnDelete();
            $table->foreignId('cartao_id')->constrained('cartaos')->cascadeOnDelete();
            $table->integer('ordem')->default(0); // Renomeado de 'position' para 'ordem'
            $table->timestamps();

            $table->unique(['rotina_id', 'cartao_id']);
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('rotina_cartaos');
    }
};
