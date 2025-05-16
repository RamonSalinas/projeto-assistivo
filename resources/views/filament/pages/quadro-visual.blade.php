<x-filament-panels::page>
    <h2 class="text-xl font-bold mb-4">Quadro: {{ $this->board->name }}</h2>

    <div 
        x-data 
        x-init="
            Sortable.create($el, {
                group: 'shared',
                animation: 150,
                onEnd: (event) => {
                    const columnOrder = Array.from($el.children).map(el => el.dataset.id);
                    $wire.updateColumnOrder(columnOrder);
                }
            });
        "
        class="flex gap-4 overflow-x-auto"
    >
        @foreach ($this->board->columns as $coluna)
            <div 
                class="bg-gray-100 p-4 rounded shadow w-64 flex-shrink-0"
                data-id="{{ $coluna->id }}"
            >
                <h3 class="text-lg font-semibold mb-2">{{ $coluna->name }}</h3>
                <div 
                    x-data 
                    x-init="
                        Sortable.create($el, {
                            group: 'shared',
                            animation: 150,
                            onEnd: (event) => {
                                const cardOrder = Array.from($el.children).map(el => el.dataset.id);
                                $wire.updateCardOrder({{ $coluna->id }}, cardOrder);
                            }
                        });
                    "
                    class="space-y-2 min-h-[100px]"
                >
                    @foreach ($coluna->cartaos as $cartao)
                        <div 
                            class="p-2 bg-white border rounded shadow-sm text-sm"
                            data-id="{{ $cartao->id }}"
                        >
                            {{ $cartao->titulo }}
                        </div>
                    @endforeach
                </div>
            </div>
        @endforeach
    </div>
</x-filament-panels::page>