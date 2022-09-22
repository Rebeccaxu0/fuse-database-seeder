<x-app-layout>

    <x-slot name="title">{{ __('My Ideas') }}</x-slot>

    <x-slot name="header">{{ __('My Ideas') }}</x-slot>

    <x-challenge-gallery-menu />

    <div class="px-16 py-8 bg-neutral-100 grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 xl:grid-cols-4 gap-4">
        <livewire:student.idea-edit />

        @foreach ($ideas as $idea)
            <x-idea-tile :idea="$idea" />
        @endforeach
    </div>
    <livewire:ideas-trailer />
</x-app-layout>
