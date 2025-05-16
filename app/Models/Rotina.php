<?php

namespace App\Models;
use Illuminate\Database\Eloquent\Factories\HasFactory;

use Illuminate\Database\Eloquent\Model;

class Rotina extends Model
{
    use HasFactory;

    protected $fillable = [
        'nome',
    ];

    public function cartaos()
    {
        return $this->belongsToMany(Cartao::class, 'rotina_cartaos')->withPivot('ordem')->orderBy('pivot_ordem');
    }
}
