<?php

namespace Database\Seeders;

use App\Models\Genero;
use App\Models\Modo;
use App\Models\Perspectiva;
use App\Models\Plataforma;
use App\Models\Tema;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        Modo::create([
            'igdb' => '1',
            'nome' => 'Um jogador'
        ]);
        Modo::create([
            'igdb' => '2',
            'nome' => 'Multijogador'
        ]);
        Modo::create([
            'igdb' => '3',
            'nome' => 'Cooperativo'
        ]);
        Modo::create([
            'igdb' => '4',
            'nome' => 'Tela Dividida'
        ]);
        Modo::create([
            'igdb' => '5',
            'nome' => 'MMO'
        ]);
        Modo::create([
            'igdb' => '6',
            'nome' => 'Battle Royale'
        ]);
        Genero::create([
            'igdb' => '4',
            'nome' => 'Luta'
        ]);
        Genero::create([
            'igdb' => '5',
            'nome' => 'Tiro'
        ]);
        Genero::create([
            'igdb' => '7',
            'nome' => 'Música'
        ]);
        Genero::create([
            'igdb' => '8',
            'nome' => 'Plataforma'
        ]);
        Genero::create([
            'igdb' => '4',
            'nome' => 'Luta'
        ]);
        Genero::create([
            'igdb' => '9',
            'nome' => 'Quebra-Cabeças'
        ]);
        Genero::create([
            'igdb' => '10',
            'nome' => 'Corrida'
        ]);
        Genero::create([
            'igdb' => '11',
            'nome' => 'Estratégia em tempo real'
        ]);
        Genero::create([
            'igdb' => '12',
            'nome' => 'RPG'
        ]);
        Genero::create([
            'igdb' => '4',
            'nome' => 'Luta'
        ]);
        Genero::create([
            'igdb' => '13',
            'nome' => 'Simulador'
        ]);
        Genero::create([
            'igdb' => '14',
            'nome' => 'Esporte'
        ]);
        Genero::create([
            'igdb' => '15',
            'nome' => 'Estratégia'
        ]);
        Genero::create([
            'igdb' => '24',
            'nome' => 'Tática'
        ]);
        Genero::create([
            'igdb' => '24',
            'nome' => 'Hack and Slash'
        ]);
        Genero::create([
            'igdb' => '31',
            'nome' => 'Aventura'
        ]);
        Genero::create([
            'igdb' => '33',
            'nome' => 'Arcade'
        ]);
        Genero::create([
            'igdb' => '36',
            'nome' => 'Moba'
        ]);

        Tema::create([
            'igdb' => '20',
            'nome' => 'Thriller'
        ]);
        Tema::create([
            'igdb' => '18',
            'nome' => 'Sci-fi'
        ]);
        Tema::create([
            'igdb' => '1',
            'nome' => 'Ação'
        ]);
        Tema::create([
            'igdb' => '19',
            'nome' => 'Terror'
        ]);
        Tema::create([
            'igdb' => '21',
            'nome' => 'Sobrevivência'
        ]);
        Tema::create([
            'igdb' => '17',
            'nome' => 'Fantasia'
        ]);
        Tema::create([
            'igdb' => '23',
            'nome' => 'Stealth'
        ]);
        Tema::create([
            'igdb' => '27',
            'nome' => 'Comédia'
        ]);
        Tema::create([
            'igdb' => '31',
            'nome' => 'Drama'
        ]);
        Tema::create([
            'igdb' => '38',
            'nome' => 'Mundo Aberto'
        ]);
        Perspectiva::create([
            'igdb' => '1',
            'nome' => 'Primeira Pessoa'
        ]);
        Perspectiva::create([
            'igdb' => '5',
            'nome' => 'Texto'
        ]);
        Perspectiva::create([
            'igdb' => '2',
            'nome' => 'Terceira Pessoa'
        ]);
        Perspectiva::create([
            'igdb' => '7',
            'nome' => 'VR'
        ]);
    }
}
