<x-alum-layout>
    <x-slot name="title">{{ __('Registered Lobby') }}</x-slot>
    <main class="container flex-shrink flex-grow
                 min-h-screen mx-auto py-16
                 lg:px-4">
        <div class="mx-auto mt-16 my-auto p-8 w-2/3
               bg-gradient-to-t from-fuse-teal-100 to-white
               rounded-lg border
               sm:px-12 lg:flex lg:w-2/3" style="box-shadow: -10px 5px 20px rgba(0, 0, 0, .35)">
            <div class="lg:flex-1">
                <img alt="{{ __('FUSE Logo') }}" title="{{ __('FUSE Logo') }}" class="mx-auto min-h-8 max-h-36 md:max-h-48 lg:max-h-72 lg:pr-12 lg:pt-24 xl:pt-16" src="/fuse-logo.svg">
            </div>
            <div class="lg:flex-1">
                <livewire:alum-registration />
            </div>
        </div>
        <x-jet-banner/>
    </main>
</x-alum-layout>