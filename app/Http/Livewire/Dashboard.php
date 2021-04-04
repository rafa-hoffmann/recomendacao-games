<?php

namespace App\Http\Livewire;

use App\Models\Genero;
use App\Models\Jogo;
use App\Models\Modo;
use App\Models\Perspectiva;
use App\Models\Tema;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Pagination\LengthAwarePaginator;
use Illuminate\Pagination\Paginator;
use Livewire\Component;
use Livewire\WithPagination;
use MarcReichel\IGDBLaravel\Models\Game;

class Dashboard extends Component
{
    public $busca = '';
    public $tipo = 0;
    use WithPagination;

    public function updatingBusca()
    {
        $this->resetPage();
    }

    public function mount()
    {
        // popula a tabela com os jogos mais populares
        if (Jogo::count() < 1) {

            $modos = Modo::all();
            $generos = Genero::all();
            $temas = Tema::all();
            $perspectivas = Perspectiva::all();

            $games = Game::with(['game_modes', 'genres', 'themes', 'player_perspectives'])
                ->where('total_rating_count', '>', 0)
                ->where('category', 0)
                ->orderBy('total_rating_count', 'desc')
                ->take(1000)->get();

            foreach ($games as $game) {
                $jogo = Jogo::firstOrCreate(
                    ['igdb' => $game->id],
                    ['nome' => $game->name]
                );

                if ($game->genres)
                    $jogo->generos()->sync($generos->whereIn('igdb', $game->genres->pluck('id')));
                if ($game->game_modes)
                    $jogo->modos()->sync($modos->whereIn('igdb', $game->game_modes->pluck('id')));
                if ($game->themes)
                    $jogo->temas()->sync($temas->whereIn('igdb', $game->themes->pluck('id')));
                if ($game->player_perspectives)
                    $jogo->perspectivas()->sync($perspectivas->whereIn('igdb', $game->player_perspectives->pluck('id')));
                $jogo->save();
            }
        }
    }

    public function render()
    {
        $busca = $this->busca;
        $jogos = collect();
        switch ($this->tipo) {
            case 0:
                $jogos = Jogo::with('generos', 'temas', 'modos', 'perspectivas')
                ->where('nome', 'like', '%'.$this->busca.'%')
                ->orWhereHas('generos', function ($query) use ($busca) {
                    return $query->where('nome', 'like', '%'.$busca.'%');
                })
                ->orWhereHas('temas', function ($query) use ($busca) {
                    return $query->where('nome', 'like', '%'.$busca.'%');
                })
                ->orWhereHas('modos', function ($query) use ($busca) {
                    return $query->where('nome', 'like', '%'.$busca.'%');
                })
                ->orWhereHas('perspectivas', function ($query) use ($busca) {
                    return $query->where('nome', 'like', '%'.$busca.'%');
                })
                ->orderByRaw('(likes+dislikes) DESC')
                ->paginate(10);
                break;
            case 1:
                $jogos = Jogo::with('generos', 'temas', 'modos', 'perspectivas')
                ->where('nome', 'like', '%'.$this->busca.'%')
                ->orWhereHas('generos', function ($query) use ($busca) {
                    return $query->where('nome', 'like', '%'.$busca.'%');
                })
                ->orWhereHas('temas', function ($query) use ($busca) {
                    return $query->where('nome', 'like', '%'.$busca.'%');
                })
                ->orWhereHas('modos', function ($query) use ($busca) {
                    return $query->where('nome', 'like', '%'.$busca.'%');
                })
                ->orWhereHas('perspectivas', function ($query) use ($busca) {
                    return $query->where('nome', 'like', '%'.$busca.'%');
                })
                ->orderByRaw('(likes+dislikes) DESC')
                ->get();
                $jogos = $this->paginate($jogos->sortByDesc(function ($jogo) {
                    if ($jogo->avaliacoes == 0) {
                        return 0;
                    }
                    return $jogo->likes / $jogo->avaliacoes * 100;
                }));
                break;
            case 2:
                $jogos = auth()->user()->generos()->with('jogos')
                ->whereHas('jogos', function ($query) use ($busca) {
                    $query->where('nome', 'like', '%'.$this->busca.'%')
                    ->orWhereHas('generos', function ($query) use ($busca) {
                        return $query->where('nome', 'like', '%'.$busca.'%');
                    })
                    ->orWhereHas('temas', function ($query) use ($busca) {
                        return $query->where('nome', 'like', '%'.$busca.'%');
                    })
                    ->orWhereHas('modos', function ($query) use ($busca) {
                        return $query->where('nome', 'like', '%'.$busca.'%');
                    })
                    ->orWhereHas('perspectivas', function ($query) use ($busca) {
                        return $query->where('nome', 'like', '%'.$busca.'%');
                    });
                })
                ->orderBy('pivot_relevancia', 'desc')->get();
                $jogos = $this->paginate($jogos->pluck('jogos')->flatten());
                break;
            case 3:
                $jogos = auth()->user()->modos()->with('jogos')
                ->whereHas('jogos', function ($query) use ($busca) {
                    $query->where('nome', 'like', '%'.$this->busca.'%')
                    ->orWhereHas('generos', function ($query) use ($busca) {
                        return $query->where('nome', 'like', '%'.$busca.'%');
                    })
                    ->orWhereHas('temas', function ($query) use ($busca) {
                        return $query->where('nome', 'like', '%'.$busca.'%');
                    })
                    ->orWhereHas('modos', function ($query) use ($busca) {
                        return $query->where('nome', 'like', '%'.$busca.'%');
                    })
                    ->orWhereHas('perspectivas', function ($query) use ($busca) {
                        return $query->where('nome', 'like', '%'.$busca.'%');
                    });
                })->orderBy('pivot_relevancia', 'desc')->get();
                $jogos = $this->paginate($jogos->pluck('jogos')->flatten());
                break;
            case 4:
                $jogos = auth()->user()->temas()->with('jogos')
                ->whereHas('jogos', function ($query) use ($busca) {
                    $query->where('nome', 'like', '%'.$this->busca.'%')
                    ->orWhereHas('generos', function ($query) use ($busca) {
                        return $query->where('nome', 'like', '%'.$busca.'%');
                    })
                    ->orWhereHas('temas', function ($query) use ($busca) {
                        return $query->where('nome', 'like', '%'.$busca.'%');
                    })
                    ->orWhereHas('modos', function ($query) use ($busca) {
                        return $query->where('nome', 'like', '%'.$busca.'%');
                    })
                    ->orWhereHas('perspectivas', function ($query) use ($busca) {
                        return $query->where('nome', 'like', '%'.$busca.'%');
                    });
                })->orderBy('pivot_relevancia', 'desc')->get();
                $jogos = $this->paginate($jogos->pluck('jogos')->flatten());
                break;
            case 5:
                $jogos = auth()->user()->perspectivas()->with('jogos')
                ->whereHas('jogos', function ($query) use ($busca) {
                    $query->where('nome', 'like', '%'.$this->busca.'%')
                    ->orWhereHas('generos', function ($query) use ($busca) {
                        return $query->where('nome', 'like', '%'.$busca.'%');
                    })
                    ->orWhereHas('temas', function ($query) use ($busca) {
                        return $query->where('nome', 'like', '%'.$busca.'%');
                    })
                    ->orWhereHas('modos', function ($query) use ($busca) {
                        return $query->where('nome', 'like', '%'.$busca.'%');
                    })
                    ->orWhereHas('perspectivas', function ($query) use ($busca) {
                        return $query->where('nome', 'like', '%'.$busca.'%');
                    });
                })->orderBy('pivot_relevancia', 'desc')->get();
                $jogos = $this->paginate($jogos->pluck('jogos')->flatten());
                break;
        }

        return view('livewire.dashboard', [
            'jogosRecomendados' => $jogos
        ]);
    }

    public function paginate($items, $perPage = 10, $page = null, $options = [])
    {
        $page = $page ?: (Paginator::resolveCurrentPage() ?: 1);

        $items = $items instanceof Collection ? $items : Collection::make($items);

        return new LengthAwarePaginator($items->forPage($page, $perPage), $items->count(), $perPage, $page, $options);
    }

    public function likeGame($id)
    {
        $jogo = Jogo::with('generos', 'modos', 'temas', 'perspectivas')->find($id);

        if (empty($jogo)) {
            return;
        }

        auth()->user()->generos()->syncWithoutDetaching($jogo->generos);
        auth()->user()->modos()->syncWithoutDetaching($jogo->modos);
        auth()->user()->temas()->syncWithoutDetaching($jogo->temas);
        auth()->user()->perspectivas()->syncWithoutDetaching($jogo->perspectivas);

        foreach ($jogo->generos as $generoJogo) {
            foreach (auth()->user()->generos as $generoUser) {
                if ($generoJogo->id == $generoUser->id) {
                    $generoUser->pivot->relevancia++;
                    $generoUser->pivot->save();
                }
            }
        }

        foreach ($jogo->modos as $jogoModo) {
            foreach (auth()->user()->modos as $modoUser) {
                if ($jogoModo->id == $modoUser->id) {
                    $modoUser->pivot->relevancia++;
                    $modoUser->pivot->save();
                }
            }
        }

        foreach ($jogo->temas as $tema) {
            foreach (auth()->user()->temas as $temaUser) {
                if ($tema->id == $temaUser->id) {
                    $temaUser->pivot->relevancia++;
                    $temaUser->pivot->save();
                }
            }
        }

        foreach ($jogo->perspectivas as $perspectiva) {
            foreach (auth()->user()->perspectivas as $perspectivaUser) {
                if ($perspectiva->id == $perspectivaUser->id) {
                    $perspectivaUser->pivot->relevancia++;
                    $perspectivaUser->pivot->save();
                }
            }
        }


        $jogo->likes++;
        $jogo->save();
    }

    public function dislikeGame($id)
    {
        $jogo = Jogo::with('generos', 'modos', 'temas', 'perspectivas')->find($id);

        if (empty($jogo)) {
            return;
        }

        auth()->user()->generos()->syncWithoutDetaching($jogo->generos);
        auth()->user()->modos()->syncWithoutDetaching($jogo->modos);
        auth()->user()->temas()->syncWithoutDetaching($jogo->temas);
        auth()->user()->perspectivas()->syncWithoutDetaching($jogo->perspectivas);

        foreach ($jogo->generos as $generoJogo) {
            foreach (auth()->user()->generos as $generoUser) {
                if ($generoJogo->id == $generoUser->id) {
                    $generoUser->pivot->relevancia--;
                    $generoUser->pivot->save();
                }
            }
        }

        foreach ($jogo->modos as $jogoModo) {
            foreach (auth()->user()->modos as $modoUser) {
                if ($jogoModo->id == $modoUser->id) {
                    $modoUser->pivot->relevancia--;
                    $modoUser->pivot->save();
                }
            }
        }

        foreach ($jogo->temas as $tema) {
            foreach (auth()->user()->temas as $temaUser) {
                if ($tema->id == $temaUser->id) {
                    $temaUser->pivot->relevancia--;
                    $temaUser->pivot->save();
                }
            }
        }

        foreach ($jogo->perspectivas as $perspectiva) {
            foreach (auth()->user()->perspectivas as $perspectivaUser) {
                if ($perspectiva->id == $perspectivaUser->id) {
                    $perspectivaUser->pivot->relevancia--;
                    $perspectivaUser->pivot->save();
                }
            }
        }

        $jogo->dislikes++;
        $jogo->save();
    }
}
