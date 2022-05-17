<x-guest-logo-layout>
    <x-slot name="title">{{ __('Lobby') }}</x-slot>
    <div class="mt-6 grid grid-cols-1 gap-6 max-w-full">
        <x-jet-validation-errors />
        <h1 class="mt-6 text-fuse-teal text-3xl font-bold font-display text-left">{{ __('Welcome to FUSE!') }}</h1>
        <livewire:lobby-join-studio />
        <p class="rounded py-2 text-fuse-dk-teal text-base md:text-sm text-center">
            <a class="ml-6 underline" href="https://www.fusestudio.net/">Free Trial</a>
            <a class="ml-6 underline" href="https://www.fusestudio.net/">Why Fuse?</a>
            <a class="ml-6 underline" href="https://www.fusestudio.net/">For Teachers</a>
        </p>
    </div>
</x-guest-logo-layout>