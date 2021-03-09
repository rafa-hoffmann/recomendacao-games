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
    public $games;

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

        $modos = Modo::whereIn('id', $this->selectedModes)->orderByDesc("nota")->get();
        $generos = Genero::whereIn('id', $this->selectedGenres)->orderByDesc("nota")->get();
        $temas = Tema::whereIn('id', $this->selectedThemes)->orderByDesc("nota")->get();
        $perspectivas = Perspectiva::whereIn('id', $this->selectedPerspectives)->orderByDesc("nota")->get();

        $games = Game::whereIn('genres', array_column($generos->toArray(), "igdb"))
        ->whereIn('game_modes', array_column($modos->toArray(), "igdb"))
        ->whereIn('themes', array_column($temas->toArray(), "igdb"))
        ->whereIn('player_perspectives', array_column($perspectivas->toArray(), "igdb"))
        ->orderBy('total_rating_count', 'desc')
        ->get();

        $jogos = collect();
        foreach($games as $game) {
            $jogo = Jogo::firstOrCreate(
                ['igdb' => $game->id],
                ['nome' => $game->name]
            );
            $jogo->nota++;
            $jogo->save();
            $jogos->add($jogo);
        }

        foreach($modos as $modo) {
            $modo->nota++;
            $modo->save();
        }

        dd($games);
    }
}
