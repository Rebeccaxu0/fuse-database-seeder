<x-app-layout>

    <x-slot name="title">{{ __('My Ideas') }}</x-slot>

    <x-slot name="header">{{ __('My Ideas') }}</x-slot>

    <x-challenge-gallery-menu />

    <div class="bg-slate-200 p-8 grid grid-cols-3 gap-4">

    <livewire:new-idea />

    @foreach ($ideas as $idea)
        <x-idea-tile :idea="$idea" />
    @endforeach
    </div>
</x-app-layout>
