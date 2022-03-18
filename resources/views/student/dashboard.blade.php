<x-app-layout>

    <x-slot name="title">{{ __('My Dashboard') }}</x-slot>

    <x-slot name="header">{{ __('My Dashboard') }}</x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <section class="sm:grid gap-4 sm:grid-cols-6">
                <x-dashboard-status class="sm:col-span-3 md:col-span-4"/>
                <section class="sm:col-span-3 md:col-span-2
                  bg-gradient-to-t from-fuse-teal to-fuse-teal-dk-800">
                    <a href="{{ route('student.help_finder') }}"
                      class="w-full h-full flex flex-col items-center p-4">
                        <img class="w-1/2"
                              srcset="/img/dashboard-help-finder-4x.png 4x, /img/dashboard-help-finder-2x.png 2x"
                              src="/img/dashboard-help-finder-2x.png"
                              alt="{{ __('Three help icons') }}">
                        <button class="">{{ __('Help Finder') }}</button>
                    </a>
                </section>
            </section>

            <div id="bottom-cluster">

                <x-activity-feed />

                <div id="sidebar">
                    {{ __('How To FUSE') }}
                    <div id="intro-videos">
                    </div>

                    <x-studio-notes />

                    <x-explore-tile />

                    <x-in-progress />
                </div>

            </div>
        </div>
    </div>
</x-app-layout>
