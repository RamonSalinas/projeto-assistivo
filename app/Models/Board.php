<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Board extends Model
{
    use HasFactory;

    protected $fillable = ['name'];

    public function columns()
    {
        return $this->hasMany(Column::class)->orderBy('order'); // Ordena as colunas pela ordem
    }
}