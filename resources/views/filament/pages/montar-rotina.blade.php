<x-filament-panels::page>
    <div class="grid grid-cols-2 gap-4">
        <!-- Coluna: Cartões Disponíveis -->
        <div>
            <h2 class="text-xl font-bold mb-2 text-gray-800 dark:text-gray-200">Cartões Disponíveis</h2>
            <div class="space-y-2 max-h-[600px] overflow-y-auto">
                @foreach ($cards as $card)
                    <div class="flex items-center bg-white dark:bg-gray-800 p-2 shadow rounded">
                        <img src="{{ Storage::url($card->imagem) }}" alt="Imagem do cartão" class="w-16 h-16 object-cover rounded mr-2" />
                        <div class="flex-1">
                            <div class="font-semibold text-gray-800 dark:text-gray-200">{{ $card->titulo }}</div>
                            <div class="text-sm text-gray-500 dark:text-gray-400">{{ $card->categoria }}</div>
                        </div>
                        @if (!in_array($card->id, $selectedCards))
                            <button type="button" wire:click="addCard({{ $card->id }})"
                                class="ml-2 px-3 py-1 bg-primary-600 text-white dark:bg-primary-500 dark:text-white text-sm rounded hover:bg-primary-700 dark:hover:bg-primary-600">
                                Adicionar
                            </button>
                        @else
                            <button disabled
                                class="ml-2 px-3 py-1 bg-gray-200 text-gray-500 dark:bg-gray-700 dark:text-gray-400 text-sm rounded cursor-not-allowed">
                                Adicionado
                            </button>
                        @endif
                    </div>
                @endforeach
            </div>
        </div>

        <!-- Coluna: Cartões Selecionados e Formulário -->
        <div>
            <h2 class="text-xl font-bold mb-2 text-gray-800 dark:text-gray-200">Cartões Selecionados</h2>
            <div 
                x-data 
                x-sortable 
                x-on:end="$wire.updateOrder(Array.from($event.target.children).map(el => el.dataset.id))"
                class="space-y-2 max-h-[600px] overflow-y-auto"
            >
                @foreach ($selectedCards as $id)
                    @php $c = $this->selectedCardModels[$id] @endphp
                    <div data-id="{{ $c->id }}" x-sortable-handle class="flex items-center bg-white dark:bg-gray-800 p-2 shadow rounded">
                        <img src="{{ Storage::url($c->imagem) }}" alt="Imagem do cartão" class="w-16 h-16 object-cover rounded mr-2" />
                        <div class="flex-1">
                            <div class="font-semibold text-gray-800 dark:text-gray-200">{{ $c->titulo }}</div>
                            <div class="text-sm text-gray-500 dark:text-gray-400">{{ $c->categoria }}</div>
                        </div>
                        <button type="button" wire:click="removeCard({{ $c->id }})"
                            class="ml-2 px-2 py-1 bg-red-600 text-white dark:bg-red-500 dark:text-white text-sm rounded hover:bg-red-700 dark:hover:bg-red-600">
                            Remover
                        </button>
                    </div>
                @endforeach
            </div>
            <!-- Campo Nome da Rotina -->
            <div class="mt-4">
                <label for="name" class="block font-medium text-sm text-gray-800 dark:text-gray-200">Nome da rotina</label>
                <input type="text" id="name" wire:model.defer="name"
                    class="mt-1 block w-full border-gray-300 dark:border-gray-700 bg-white dark:bg-gray-800 text-gray-800 dark:text-gray-200 rounded-md shadow-sm" />
                @error('name') <p class="text-red-600 dark:text-red-400 text-sm">{{ $message }}</p> @enderror
            </div>
            <!-- Botão Salvar -->
            <div class="mt-4">
                <button wire:click="saveRoutine"
                    class="px-4 py-2 bg-primary-600 text-white dark:bg-primary-500 dark:text-white text-sm rounded hover:bg-primary-700 dark:hover:bg-primary-600">
                    {{ $editingRoutineId ? 'Atualizar Rotina' : 'Salvar Rotina' }}
                </button>
            </div>
        </div>
    </div>

    <!-- Lista de Rotinas Existentes -->
    <div class="mt-8">
        <h2 class="text-xl font-bold mb-2 text-gray-800 dark:text-gray-200">Rotinas Criadas</h2>
        <div class="space-y-2">
            @foreach ($rotinas as $rotina)
                <div class="flex items-center bg-white dark:bg-gray-800 p-2 shadow rounded">
                    <div class="flex-1">
                        <div class="font-semibold text-gray-800 dark:text-gray-200">{{ $rotina->nome }}</div>
                        <div class="text-sm text-gray-500 dark:text-gray-400">
                            {{ $rotina->cartaos->count() }} cartões
                        </div>
                    </div>
                    <button type="button" wire:click="editRoutine({{ $rotina->id }})"
                        class="ml-2 px-3 py-1 bg-blue-600 text-white dark:bg-blue-500 dark:text-white text-sm rounded hover:bg-blue-700 dark:hover:bg-blue-600">
                        Editar
                    </button>
                    <button type="button" wire:click="deleteRoutine({{ $rotina->id }})"
                        class="ml-2 px-3 py-1 bg-red-600 text-white dark:bg-red-500 dark:text-white text-sm rounded hover:bg-red-700 dark:hover:bg-red-600">
                        Excluir
                    </button>
                </div>
            @endforeach
        </div>
    </div>
</x-filament-panels::page>