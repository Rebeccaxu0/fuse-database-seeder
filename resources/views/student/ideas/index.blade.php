<x-app-layout>

    <x-slot name="title">{{ __('My Ideas') }}</x-slot>

    <x-slot name="header">
        <span class="relative mr-2">
            <x-avatar :user="auth()->user()" class="h-16 w-16"/>
        </span>
        {{ __('My Ideas') }}
    </x-slot>

    <x-challenge-gallery-menu />

    <div class="px-16 py-8 bg-neutral-100 grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 xl:grid-cols-4 gap-4">
        <livewire:student.idea-edit />

        @foreach ($ideas as $idea)
            <x-idea-tile :idea="$idea" />
        @endforeach
    </div>
    <livewire:ideas-trailer />
</x-app-layout>
