<x-app-layout>

    <x-admin.district-subnav />

    <x-slot name="header">{{ __('Studios') }}</x-slot>
    <div class="relative">
        @livewire('studio-index')
    </div>
</x-app-layout>
