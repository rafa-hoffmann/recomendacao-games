<div class="p-5">
    @if($page == 0)
    <p class="text-2xl">Quais são seus modos de interesse?</p>
    @foreach($modos as $modo)
    <div class="mt-4 space-y-4">
        <div class="flex items-start">
            <div class="flex items-center h-5">
                <input id="modo{{$modo->id}}" name="modos[]" type="checkbox"
                    class="focus:ring-indigo-500 h-4 w-4 text-indigo-600 border-gray-300 rounded"
                    wire:model="selectedModes" value="{{$modo->id}}">
            </div>
            <div class="ml-3 text-sm">
                <label for="modo{{$modo->id}}" class="font-medium text-gray-700">{{$modo->nome}}</label>
            </div>
        </div>
    </div>
    @endforeach
    <div class="flex mt-4">
        <div class="flex flex-1">
            <x-button type="button" wire:click="nextPage">Avançar</x-button>
        </div>
        <x-button type="button" wire:click="getRecommendations">Gerar Recomendações</x-button>
    </div>
    @elseif($page == 1)
    <p class="text-2xl">Qual gênero você está a fim de jogar?</p>
    @foreach($generos as $genero)
    <div class="mt-4 space-y-4">
        <div class="flex items-start">
            <div class="flex items-center h-5">
                <input id="genero{{$genero->id}}" name="generos[]" type="checkbox"
                    class="focus:ring-indigo-500 h-4 w-4 text-indigo-600 border-gray-300 rounded"
                    wire:model="selectedGenres" value="{{$genero->id}}">
            </div>
            <div class="ml-3 text-sm">
                <label for="genero{{$genero->id}}" class="font-medium text-gray-700">{{$genero->nome}}</label>
            </div>
        </div>
    </div>
    @endforeach
    <div class="flex mt-4">
        <div class="flex flex-1">
            <x-button type="button" wire:click="previousPage">Voltar</x-button>
            <x-button type="button" class="ml-4" wire:click="nextPage">Avançar</x-button>
        </div>
        <x-button type="button" wire:click="getRecommendations">Gerar Recomendações</x-button>
    </div>
    @elseif($page == 2)
    <p class="text-2xl">Escolha um ou mais temas de jogo</p>
    @foreach($temas as $tema)
    <div class="mt-4 space-y-4">
        <div class="flex items-start">
            <div class="flex items-center h-5">
                <input id="tema{{$tema->id}}" name="temas[]" type="checkbox"
                    class="focus:ring-indigo-500 h-4 w-4 text-indigo-600 border-gray-300 rounded"
                    wire:model="selectedThemes" value="{{$tema->id}}">
            </div>
            <div class="ml-3 text-sm">
                <label for="tema{{$tema->id}}" class="font-medium text-gray-700">{{$tema->nome}}</label>
            </div>
        </div>
    </div>
    @endforeach
    <div class="flex mt-4">
        <div class="flex flex-1">
            <x-button type="button" wire:click="previousPage">Voltar</x-button>
            <x-button type="button" class="ml-4" wire:click="nextPage">Avançar</x-button>
        </div>
        <x-button type="button" wire:click="getRecommendations">Gerar Recomendações</x-button>
    </div>
    @elseif($page == 3)
    <p class="text-2xl">Por último, escolha algumas de suas perspectivas favoritas</p>
    @foreach($perspectivas as $perspectiva)
    <div class="mt-4 space-y-4">
        <div class="flex items-start">
            <div class="flex items-center h-5">
                <input id="perspectiva{{$perspectiva->id}}" name="perspectivas[]" type="checkbox"
                    class="focus:ring-indigo-500 h-4 w-4 text-indigo-600 border-gray-300 rounded"
                    wire:model="selectedPerspectives" value="{{$perspectiva->id}}">
            </div>
            <div class="ml-3 text-sm">
                <label for="perspectiva{{$perspectiva->id}}"
                    class="font-medium text-gray-700">{{$perspectiva->nome}}</label>
            </div>
        </div>
    </div>
    @endforeach
    <div class="flex mt-4">
        <div class="flex flex-1">
            <x-button type="button" wire:click="previousPage">Voltar</x-button>
        </div>
        <x-button type="button" wire:click="getRecommendations">Gerar Recomendações</x-button>
    </div>
    @endif

    @if(!empty($jogos))
    @foreach($jogos as $jogo)
    <div class="mt-4 space-y-4">
        <div class="flex items-start">
            <p>{{$jogo->nome}}</p>
        </div>
    </div>
    @endforeach
    @endif
</div>
