<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Dashboard') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-xl sm:rounded-lg">

                <div id="top-cluster">
                    <x-dashboard-status />
                    <x-help-finder-tile />
                </div>

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
    </div>
</x-app-layout>
