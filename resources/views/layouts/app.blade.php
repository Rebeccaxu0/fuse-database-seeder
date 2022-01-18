<x-base-layout :title="$title ?? ''">

    <div id='env' class="flex flex-col bg-white container shadow-2xl p-0 min-h-screen {{ $roleClass }}">
        <main class="flex-grow relative py-20 px-8">
            {{ $slot }}
            <x-impersonate />
        </main>

        <x-footer />
    </div>

</x-base-layout>
