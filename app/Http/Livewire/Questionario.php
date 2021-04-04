<?php

namespace App\Http\Livewire;

use App\Models\Genero;
use App\Models\Jogo;
use App\Models\Modo;
use App\Models\Perspectiva;
use App\Models\Tema;
use Livewire\Component;
use MarcReichel\IGDBLaravel\Models\Game;

class Questionario extends Component
{
    public $page = 0;
    public $selectedGenres = [];
    public $selectedModes = [];
    public $selectedThemes = [];
    public $selectedPerspectives = [];
    public $jogos = [];

    public function render()
    {
        $data = [
            "modos" => Modo::all(),
            "generos" => Genero::all(),
            "temas" => Tema::all(),
            "perspectivas" => Perspectiva::all()
        ];
        return view('livewire.questionario', $data);
    }

    public function nextPage()
    {
        if($this->page == 3) {
            return;
        }

        $this->page++;
    }

    public function previousPage()
    {
        if($this->page == 0) {
            return;
        }

        $this->page--;
    }

    public function getRecommendations() {
        $modos = Modo::whereIn('id', $this->selectedModes)->get();
        $generos = Genero::whereIn('id', $this->selectedGenres)->get();
        $temas = Tema::whereIn('id', $this->selectedThemes)->get();
        $perspectivas = Perspectiva::whereIn('id', $this->selectedPerspectives)->get();

        $games = Game::with(['game_modes', 'genres', 'themes', 'player_perspectives'])->where('total_rating_count', '>', 0)->where('category', 0)->orderBy('total_rating_count', 'desc');

        if ($modos->first()) {
            $games = $games->whereIn('game_modes', array_column($modos->toArray(), "igdb"));
        }
        if ($generos->first()) {
            $games = $games->whereIn('genres', array_column($generos->toArray(), "igdb"));
        }
        if ($temas->first()) {
            $games = $games->whereIn('themes', array_column($temas->toArray(), "igdb"));
        }
        if ($perspectivas->first()) {
            $games = $games->whereIn('player_perspectives', array_column($perspectivas->toArray(), "igdb"));
        }

        $games = $games->get();

        $jogos = [];
        foreach($games as $game) {
            $jogo = Jogo::firstOrCreate(
                ['igdb' => $game->id],
                ['nome' => $game->name]
            );
            $jogo->nota++;
            $jogo->save();
            $jogos[] = $jogo;
        }

        foreach($modos as $modo) {
            $modo->nota++;
            $modo->save();
        }

        $this->jogos = $jogos;
    }
}
