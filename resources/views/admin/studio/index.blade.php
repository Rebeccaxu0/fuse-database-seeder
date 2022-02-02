<x-app-layout>
    <x-slot name="header">{{ __('Studios') }}</x-slot>
    <div class="relative">
        @livewire('studio-index')
    </div>
</x-app-layout>
