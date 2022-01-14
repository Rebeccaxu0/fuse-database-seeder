<x-admin-layout>

    <x-slot name="title">{{ __('Challenges') }}</x-slot>

    <x-slot name="header">{{ __('CHALLENGES') }}</x-slot>

    <h2>{{ __('Challenges') }}</h2>

    @foreach ($challenges as $challenge)
        <h3>{{ $challenge->name }}</h3>
    @endforeach

</x-admin-layout>
