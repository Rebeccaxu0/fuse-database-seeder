<x-app-layout>
    <x-slot name="header">{{ __('Schools') }}</x-slot>
    <a href="{{ route('admin.schools.create') }}">
        <button class="text-md h-12 px-6 m-2 bg-fuse-green rounded-lg text-white">Add School</button>
    </a>
    <div class="relative">
        @livewire('school-index')
    </div>
</x-app-layout>
