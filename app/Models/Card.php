<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Card extends Model
{
    use HasFactory;

    protected $fillable = ['title', 'column_id'];

    public function columns()
    {
        return $this->hasMany(Column::class)->orderBy('order'); // Adicione o `orderBy` para garantir que as colunas sejam ordenadas corretamente
    }
}