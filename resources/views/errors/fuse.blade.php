@guest
    <x-guest-layout>
        <x-slot name="title">@yield('title')</x-slot>
        <x-slot name="login">true</x-slot>

        <main class="container flex-shrink flex-grow
                    min-h-screen mx-auto py-16
                    lg:px-4">
            <div class="mx-auto my-auto p-8 w-2/3
                bg-gradient-to-t from-fuse-teal-100 to-white
                rounded-lg border
                sm:px-12 lg:flex lg:w-2/3"
                style="box-shadow: -10px 5px 20px rgba(0, 0, 0, .35)">
                <div class="lg:flex-1">
                    <img alt="{{ __('FUSE Logo') }}" title="{{ __('FUSE Logo') }}" class="mx-auto min-h-8 max-h-36 md:max-h-48 lg:max-h-72 lg:pr-12 lg:pt-24 xl:pt-16" src="{{ asset('/img/fuse-logo.svg') }}">
                </div>
                <div class="relative flex items-top justify-center sm:items-center sm:pt-0">
                    <div class="max-w-xl mx-auto sm:px-6 lg:px-8">
                        <div class="flex items-center pt-8 sm:justify-start sm:pt-0">
                            <div class="px-4 text-lg border-r border-gray-400 tracking-wider">
                                @yield('code')
                            </div>

                            <div class="ml-4 text-lg uppercase tracking-wider">
                                @yield('message')
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </main>
    </x-guest-layout>
@else
    <x-app-layout>
        <x-slot name="title">@yield('title')</x-slot>

        <div class="border border-2 rounded-xl p-4 shadow-md">
            <div class="px-4 text-lg tracking-wider">
                @yield('code')
            </div>

            <div class="ml-4 text-lg uppercase tracking-wider">
                @yield('message')
            </div>
        </div>
    </x-app-layout>
@endguest
