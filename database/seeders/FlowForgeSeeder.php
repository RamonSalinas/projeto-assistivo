<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Board;

class FlowForgeSeeder extends Seeder
{
    public function run(): void
    {
        $board = Board::firstOrCreate(['name' => 'Rotina do Dia']);

        $columns = $board->columns()->count()
            ? $board->columns
            : $board->columns()->createMany([
                ['name' => 'Antes da aula'],
                ['name' => 'Durante a aula'],
                ['name' => 'Depois da aula'],
            ]);

        foreach ($columns as $column) {
            $column->cards()->createMany([
                ['title' => 'Chegar na escola'],
                ['title' => 'Ir ao banheiro'],
                ['title' => 'Lavar as mãos'],
            ]);
        }
    }
}