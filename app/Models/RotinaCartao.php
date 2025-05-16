<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Relations\Pivot;
use Spatie\EloquentSortable\Sortable;
use Spatie\EloquentSortable\SortableTrait;

class RotinaCartao extends Pivot implements Sortable
{
    use HasFactory, SortableTrait;

    protected $table = 'rotina_cartaos';

    protected $fillable = [
        'rotina_id',
        'cartao_id',
        'ordem',
    ];

    /**
     * Configuração para ordenação com Spatie Sortable.
     */
    public function buildSortQuery()
    {
        return static::query()->where('rotina_id', $this->rotina_id);
    }
}