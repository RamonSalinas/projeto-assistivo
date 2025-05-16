<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::table('cartaos', function (Blueprint $table) {
            $table->foreignId('rotina_id')->nullable()->constrained('columns')->cascadeOnDelete(); // Adiciona a coluna 'rotina_id' com chave estrangeira para a tabela 'columns'
        });
    }

    public function down(): void
    {
        Schema::table('cartaos', function (Blueprint $table) {
            $table->dropForeign(['rotina_id']);
            $table->dropColumn('rotina_id'); // Remove a coluna 'rotina_id' caso a migration seja revertida
        });
    }
};