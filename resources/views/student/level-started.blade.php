<x-app-layout>

    {{ $level->challengeVersion->challenge->name }} {{ __('Level :number', ['number' => $level->level_number]) }}

</x-app-layout>
