<x-guest-logo-layout>
    <x-slot name="title">{{ __('Registered Lobby') }}</x-slot>
    <div class="mt-6 grid grid-cols-1 gap-6 max-w-full">
        <x-jet-validation-errors />
        <h1 class="mt-6 text-fuse-teal text-3xl font-bold font-display text-left">{{ __('Welcome back to FUSE!') }}</h1>
        <livewire:lobby-join-studio />
        <a class="underline text-fuse-teal font-bold" href="{{ route('student.my_stuff') }}">My stuff</a>
        <p class="rounded py-2 text-fuse-dk-teal text-base md:text-sm text-center">
            <a class="ml-6 underline" href="https://www.fusestudio.net/">Free Trial</a>
            <a class="ml-6 underline" href="https://www.fusestudio.net/">Why Fuse?</a>
            <a class="ml-6 underline" href="https://www.fusestudio.net/">For Teachers</a>
        </p>
    </div>
</x-guest-logo-layout>