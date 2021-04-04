<div>
    <h1 class="text-3xl font-bold pt-8 p-2">Jogos Recomendados</h1>
    <div class="p-2">
        <label for="tipo" class="block text-sm font-medium text-gray-700">Recomendações por</label>
        <select id="tipo" name="tipo" autocomplete="country" wire:model="tipo"
            class="mt-1 block w-full py-2 px-3 border border-gray-300 bg-white rounded-md shadow-sm focus:outline-none focus:ring-indigo-500 focus:border-indigo-500 sm:text-sm">
            <option value="0">Popularidade</option>
            <option value="1">Nota</option>
            <option value="2">Meus gêneros preferidos</option>
            <option value="3">Meus modos preferidos</option>
            <option value="4">Meus temas preferidos</option>
            <option value="5">Minhas perspectivas preferidas</option>
        </select>
    </div>
    <div class="p-2">
        <label for="busca" class="block text-sm font-medium text-gray-700">Busca Personalizada</label>
        <input wire:model="busca" type="text" name="busca" id="busca" class="focus:ring-indigo-500 focus:border-indigo-500 flex-1 block w-full rounded-md sm:text-sm border-gray-300" placeholder="Nome, Gênero, etc">
    </div>
    <div class="flex flex-col p-2">
        <div class="-my-2 overflow-x-auto sm:-mx-6 lg:-mx-8">
            <div class="py-2 align-middle inline-block min-w-full sm:px-6 lg:px-8">
                <div class="shadow overflow-hidden border-b border-gray-200 sm:rounded-lg">
                    <table class="min-w-full divide-y divide-gray-200">
                        <thead class="bg-gray-50">
                            <tr>
                                <th scope="col"
                                    class="px-3 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                                    Nome
                                </th>
                                <th scope="col"
                                    class="px-3 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                                    Generos
                                </th>
                                <th scope="col"
                                    class="px-3 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                                    Modos
                                </th>
                                <th scope="col"
                                    class="px-3 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                                    Temas
                                </th>
                                <th scope="col"
                                    class="px-3 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                                    Perspectivas
                                </th>
                                <th scope="col"
                                    class="px-3 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                                    Avaliações
                                </th>
                                <th scope="col"
                                    class="px-3 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                                    Nota
                                </th>
                                <th scope="col"
                                    class="px-3 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                                    Avaliar
                                </th>
                            </tr>
                        </thead>
                        <tbody class="bg-white divide-y divide-gray-200">
                            @foreach($jogosRecomendados as $jogo)
                            <tr>
                                <td class="px-3 py-4 whitespace-nowrap">
                                    <p>{{$jogo->nome}}</p>
                                </td>
                                <td class="px-3 py-4 whitespace-nowrap">
                                    @foreach ($jogo->generos as $genero)
                                    <p>{{$genero->nome}}</p>
                                    @endforeach
                                </td>
                                <td class="px-3 py-4 whitespace-nowrap">
                                    @foreach ($jogo->modos as $modo)
                                    <p>{{$modo->nome}}</p>
                                    @endforeach
                                </td>
                                <td class="px-3 py-4 whitespace-nowrap">
                                    @foreach ($jogo->temas as $tema)
                                    <p>{{$tema->nome}}</p>
                                    @endforeach
                                </td>
                                <td class="px-3 py-4 whitespace-nowrap">
                                    @foreach ($jogo->perspectivas as $perspectiva)
                                    <p>{{$perspectiva->nome}}</p>
                                    @endforeach
                                </td>
                                <td class="px-3 py-4 whitespace-nowrap">
                                    <p>{{$jogo->avaliacoes}}</p>
                                </td>
                                <td class="px-3 py-4 whitespace-nowrap">
                                    @if ($jogo->avaliacoes > 0)
                                    <p>{{number_format(($jogo->likes / $jogo->avaliacoes * 100), 2, ',', '.')}}%</p>
                                    @else
                                    <p>Sem avaliações</p>
                                    @endif
                                </td>
                                <td class="px-3 py-4 whitespace-nowrap">
                                    <div class="flex">
                                        <button
                                            class="bg-green-700 hover:bg-green-900 text-white rounded-l text-center px-2"
                                            wire:click="likeGame({{$jogo->id}})">
                                            Like
                                        </button>
                                        <button
                                            class="bg-red-700 hover:bg-red-900 text-white rounded-r text-center px-2"
                                            wire:click="dislikeGame({{$jogo->id}})">
                                            Dislike
                                        </button>
                                    </div>
                                </td>
                            </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
    <div class="p-2 mt-2 bg-gray-100 rounded-md border-black">
        {{$jogosRecomendados->links()}}
    </div>
</div>
