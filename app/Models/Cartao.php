<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Cartao extends Model
{
    use HasFactory;

    protected $fillable = ['titulo', 'descricao', 'imagem', 'categoria'];

    public function columns()
    {
        return $this->belongsToMany(Column::class, 'rotina_cartaos', 'cartao_id', 'rotina_id')
            ->withPivot('ordem') // Inclui a ordem no relacionamento
            ->orderBy('pivot_ordem'); // Ordena os cartões pela ordem
    }
}