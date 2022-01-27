<x-base-layout :title="$title ?? ''">

    <div id='env' class="flex flex-col bg-white container shadow-2xl p-0 min-h-screen {{ $roleClass }}">

        <x-studio-switcher />

        <main class="flex-grow relative py-20 px-8">

            {{ $slot }}

            <livewire:impersonate />
        </main>

    </div>

    <x-footer />

</x-base-layout>
