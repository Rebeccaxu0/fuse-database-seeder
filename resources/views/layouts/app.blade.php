<x-base-layout :title="$title ?? ''">

    <div id='env' class="flex flex-col bg-white container shadow-2xl p-0 min-h-screen {{ $roleClass }}">

        <x-studio-switcher />

        @if (isset($header))
        <header class="bg-white shadow">
            <div
                class="text-fuse-teal-dk text-4xl font-semibold font-display
                        max-w-7xl mx-auto
                        py-0 px-4 sm:px-6 lg:px-8">
                {{ $header }}
            </div>
        </header>
        @endif

        <main class="flex-grow relative py-20 px-8">

            {{ $slot }}

            <livewire:impersonate />
        </main>

    </div>

    <x-footer />

</x-base-layout>
