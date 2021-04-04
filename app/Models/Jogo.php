<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Jogo extends Model
{
    use HasFactory;

    protected $fillable = [
        'igdb',
        'nome',
        'likes',
        'dislikes'
    ];

    protected $appends = ['avaliacoes'];

    public function generos() {
        return $this->belongsToMany(Genero::class);
    }

    public function modos() {
        return $this->belongsToMany(Modo::class);
    }

    public function temas() {
        return $this->belongsToMany(Tema::class);
    }

    public function perspectivas() {
        return $this->belongsToMany(Perspectiva::class);
    }

    public function getAvaliacoesAttribute()
    {
        return $this->likes + $this->dislikes;
    }
}
