<x-app-layout>
    <x-slot name="header">{{ __('Studios') }}</x-slot>
    <a href="{{ route('admin.studios.create') }}">
        <button class="text-md h-12 px-6 m-2 bg-fuse-green rounded-lg text-white">Add Studio</button>
    </a>
    <div class="relative">
        @livewire('studio-index')
    </div>
</x-app-layout>
