<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Modo extends Model
{
    use HasFactory;

    protected $fillable = [
        'id',
        'igdb',
        'nome'
    ];

    public function jogos() {
        return $this->belongsToMany(Jogo::class)->orderByRaw('(likes+dislikes) DESC');;
    }
}
