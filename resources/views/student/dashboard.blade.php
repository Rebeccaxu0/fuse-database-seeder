@push('scripts')
    <script src="https://fast.wistia.net/assets/external/E-v1.js" async></script>
@endpush

<x-app-layout>

    <x-slot name="title">{{ __('My Dashboard') }}</x-slot>

    <x-slot name="header">{{ __('My Dashboard') }}</x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <section class="sm:grid gap-4 sm:grid-cols-6">

                <x-dashboard-status :user="auth()->user()" class="sm:col-span-3 md:col-span-4"/>

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

            <section class="lg:grid lg:gap-4 lg:grid-cols-6">

              <x-student.activity-feed :studio="auth()->user()->activeStudio" class="lg:col-span-4"/>

                <section class="lg:col-span-2">
                    {{ __('How To FUSE') }}
                    <div class="grid gap-2 grid-cols-2 sm:grid-cols-3 lg:grid-cols-2">
                      <div>
                        <x-wistia.popover videoId="djqoj41frj" thumbnail="true" />
                          <p>{{ __('How to Fuse') }}</p>
                      </div>
                      <div<>
                        <x-wistia.popover videoId="5oger6wj12" thumbnail="true" />
                          <p>{{ __('What is FUSE') }}</p>
                      </div<>
                      <div>
                        <x-wistia.popover videoId="6idj662twx" thumbnail="true" />
                          <p>{{ __('Save & Complete') }}</p>
                      </div>
                      <div>
                        <x-wistia.popover videoId="6993vaf1uj" thumbnail="true" />
                          <p>{{ __('Upload from a Phone') }}</p>
                      </div>
                      <div>
                        <x-wistia.popover videoId="zep1qbwkss" thumbnail="true" />
                          <p>{{ __('Choose a Challenge') }}</p>
                      </div>
                      <div>
                        <x-wistia.popover videoId="rhg4msfm5d" thumbnail="true" />
                          <p>{{ __('Try Something New') }}</p>
                      </div>
                    </div>

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
