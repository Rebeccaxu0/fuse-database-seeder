@push('scripts')
    <script src="https://fast.wistia.net/assets/external/E-v1.js" async></script>
@endpush

<x-app-layout>

    <x-slot name="title">{{ __('My Dashboard') }}</x-slot>

    <x-slot name="header">{{ __('My Dashboard') }}</x-slot>

    <div class="md:bg-neutral-200 rounded-xl py-4 md:px-4">
        <div class="lg:grid lg:grid-cols-3 lg:gap-12 max-w-7xl mx-auto sm:px-6 lg:px-8">
            <section class="bg-neutral-100 px-2 py-4 rounded-xl lg:col-span-2">
                <h5 class="ml-4 mt-4 mb-1 uppercase">
                    {{ __('Most Recent') }}
                </h5>
                <x-dashboard-status :user="auth()->user()"
                     :studio="auth()->user()->activeStudio" />
                <h5 class="ml-4 mt-4 mb-1 uppercase">
                    {{ __('Activity in Our Studio') }}
                </h5>
                <x-student.activity-feed
                  :studio="auth()->user()->activeStudio"
                  class="lg:col-span-4"/>
            </section>

            <section class="py-4">
                <h5 class="ml-4 mt-4 mb-1 uppercase">
                    {{ __('Studio Tools') }}
                </h5>
                <x-dashboard.help-finder />
                @if (auth()->user()->activeStudio->dashboard_message)
                <h5 class="ml-4 mt-4 mb-1 uppercase">
                    {{ __('Studio Notes') }}
                </h5>
                <x-studio-notes :user="auth()->user()" />
                @endif
                <h5 class="ml-4 mt-4 mb-1 uppercase">
                    {{ __('In Progress') }}
                </h5>
                <x-in-progress :user="auth()->user()" />
                <h5 class="ml-4 mt-4 mb-1 uppercase">
                    {{ __('Explore') }}
                </h5>
                <x-explore-tile :user="auth()->user()" />
                <h5 class="ml-4 mt-4 mb-1 uppercase">
                    {{ __('How to FUSE') }}
                </h5>
                <x-dashboard.how-to-fuse />
            </section>
        </div>
    </div>
</x-app-layout>
