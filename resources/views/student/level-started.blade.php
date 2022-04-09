<x-app-layout>

    {{ $level->levelable->challenge->name }} {{ __('Level :number', ['number' => $level->level_number]) }}

</x-app-layout>
