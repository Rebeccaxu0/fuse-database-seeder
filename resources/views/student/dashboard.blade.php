@push('scripts')
    <script src="https://fast.wistia.net/assets/external/E-v1.js" async></script>
@endpush

<x-app-layout>

    <x-slot name="title">{{ __('My Dashboard') }}</x-slot>

    <x-slot name="header">{{ __('My Dashboard') }}</x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <section class="sm:grid gap-4 sm:grid-cols-6">
                <x-dashboard-status :user="auth()->user()"
                  :studio="auth()->user()->activeStudio"
                  class="sm:col-span-3 md:col-span-4"/>
                <x-dashboard.help-finder />
            </section>

            <section class="lg:grid lg:gap-4 lg:grid-cols-6">
                <x-student.activity-feed
                  :studio="auth()->user()->activeStudio"
                  class="lg:col-span-4"/>
                <section class="lg:col-span-2">
                    <x-dashboard.how-to-fuse />
                    <div class="grid grid-cols-1 gap-4 sm:grid-cols-2 lg:grid-cols-1">
                        <x-studio-notes :user="auth()->user()" />
                        <x-explore-tile :user="auth()->user()" />
                    </div>
                    <x-in-progress :user="auth()->user()" />
                </section>

            </section>
        </div>
    </div>
</x-app-layout>
