<?php
use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::table('cartaos', function (Blueprint $table) {
            $table->integer('ordem')->default(0); // Adiciona a coluna 'ordem' com valor padrão 0
        });
    }

    public function down(): void
    {
        Schema::table('cartaos', function (Blueprint $table) {
            $table->dropColumn('ordem'); // Remove a coluna 'ordem' caso a migration seja revertida
        });
    }
};