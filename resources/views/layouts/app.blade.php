<x-base-layout>
    <x-slot name="title">{{ $title ?? null }}</x-slot>

    <div id='env' class="flex flex-col bg-white container shadow-2xl p-0 min-h-screen">

        <x-studio-switcher />

        @if (isset($header))
        <header class="bg-white shadow">
            <div class="text-fuse-teal-dk text-4xl font-semibold font-display max-w-7xl mx-auto py-0 px-4 sm:px-6 lg:px-8">{{ $header }}</div>
        </header>
        @endif

        <main class="flex-grow relative py-20 px-8">

            {{ $slot }}

            <div class="absolute bottom-0 left-0 right-0 px-8">
              <livewire:impersonate />
            </div>
        </main>

    </div>

    <x-footer />

</x-base-layout>
