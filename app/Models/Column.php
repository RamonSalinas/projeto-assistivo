<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Column extends Model
{
    use HasFactory;

    protected $fillable = ['name', 'board_id'];

    public function cartaos()
    {
        return $this->belongsToMany(Cartao::class, 'rotina_cartaos', 'rotina_id', 'cartao_id')
            ->withPivot('ordem') // Inclui a ordem no relacionamento
            ->orderBy('pivot_ordem'); // Ordena os cartões pela ordem
    }
}