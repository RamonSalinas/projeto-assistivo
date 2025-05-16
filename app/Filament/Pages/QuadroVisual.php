<?php

namespace App\Filament\Pages;

use Filament\Pages\Page;
use App\Models\Board;
use App\Models\Column;
use App\Models\Cartao;

class QuadroVisual extends Page
{
    protected static ?string $navigationIcon = 'heroicon-o-view-columns';
    protected static ?string $navigationLabel = 'Quadro Assistivo';
    protected static string $view = 'filament.pages.quadro-visual';

    public $board;

    public function mount(): void
    {
        $this->board = Board::with('columns.cartaos')->first(); // Carrega os cartões associados às colunas

        if (!$this->board) {
            $this->board = Board::create(['name' => 'Rotina do Dia']);
            $this->board->columns()->createMany([
                ['name' => 'Antes da aula'],
                ['name' => 'Durante a aula'],
                ['name' => 'Depois da aula'],
            ]);
        }
    }

    public function updateColumnOrder(array $columnOrder): void
    {
        foreach ($columnOrder as $index => $columnId) {
            Column::where('id', $columnId)->update(['order' => $index]);
        }

        $this->board = $this->board->refresh(); // Atualiza o quadro para refletir as mudanças
    }

    public function updateCardOrder(int $rotinaId, array $cardOrder): void
    {
        foreach ($cardOrder as $index => $cartaoId) {
            Cartao::where('id', $cartaoId)->update([
                'ordem' => $index, // Atualiza a ordem do cartão
                'rotina_id' => $rotinaId, // Atualiza a rotina do cartão
            ]);
        }

        $this->board = $this->board->refresh(); // Atualiza o quadro para refletir as mudanças
    }
}