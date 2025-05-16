<?php

namespace App\Filament\Pages;

use Filament\Pages\Page;
use Filament\Notifications\Notification;
use App\Models\Cartao;
use App\Models\Rotina;

class MontarRotina extends Page
{
    protected static ?string $navigationIcon = 'heroicon-o-cog';
    protected static ?string $navigationLabel = 'Montar Rotina';
    protected static ?string $navigationGroup = 'Rotinas';
    protected static string $view = 'filament.pages.montar-rotina';

    public $cards;            // Todos os cartões disponíveis
    public $selectedCards = []; // IDs dos cartões selecionados
    public $name;             // Nome da nova rotina
    public $rotinas;          // Lista de rotinas existentes
    public $editingRoutineId; // ID da rotina sendo editada

    // Carrega os cartões e rotinas ao montar a página
    public function mount(): void
    {
        $this->cards = Cartao::all();
        $this->rotinas = Rotina::with('cartaos')->get(); // Carrega rotinas com cartões associados
    }

    // Adiciona um cartão à lista selecionada
    public function addCard(int $cardId): void
    {
        if (!in_array($cardId, $this->selectedCards)) {
            $this->selectedCards[] = $cardId;
        }
    }

    // Remove um cartão da lista selecionada
    public function removeCard(int $cardId): void
    {
        $this->selectedCards = array_values(array_filter(
            $this->selectedCards,
            fn($id) => $id !== $cardId
        ));
    }

    // Atualiza a ordem dos cartões
    public function updateOrder(array $orderedIds): void
    {
        $this->selectedCards = $orderedIds;
    }

    // Cria ou atualiza uma rotina
    public function saveRoutine(): void
    {
        $this->validate([
            'name' => 'required|string|max:255',
            'selectedCards' => 'required|array|min:1',
        ]);

        $routine = $this->editingRoutineId
            ? Rotina::findOrFail($this->editingRoutineId)
            : new Rotina();

        $routine->nome = $this->name;
        $routine->save();

        // Atualiza os cartões associados
        $routine->cartaos()->sync(
            collect($this->selectedCards)->mapWithKeys(fn($id, $index) => [$id => ['ordem' => $index + 1]])
        );

        // Notificação de sucesso
        Notification::make()
            ->title($this->editingRoutineId ? 'Rotina atualizada com sucesso!' : 'Rotina criada com sucesso!')
            ->success()
            ->send();

        // Limpa o formulário
        $this->resetForm();
        $this->rotinas = Rotina::with('cartaos')->get(); // Recarrega as rotinas
    }

    // Edita uma rotina existente
    public function editRoutine(int $routineId): void
    {
        $routine = Rotina::with('cartaos')->findOrFail($routineId);

        $this->editingRoutineId = $routine->id;
        $this->name = $routine->nome;
        $this->selectedCards = $routine->cartaos->pluck('id')->toArray();
    }

    // Exclui uma rotina
    public function deleteRoutine(int $routineId): void
    {
        Rotina::findOrFail($routineId)->delete();

        // Notificação de sucesso
        Notification::make()
            ->title('Rotina excluída com sucesso!')
            ->success()
            ->send();

        $this->rotinas = Rotina::with('cartaos')->get(); // Recarrega as rotinas
    }

    public function getSelectedCardModelsProperty()
{
    return Cartao::whereIn('id', $this->selectedCards)->get()->keyBy('id');
}

    // Reseta o formulário
    private function resetForm(): void
    {
        $this->editingRoutineId = null;
        $this->name = '';
        $this->selectedCards = [];
    }
}