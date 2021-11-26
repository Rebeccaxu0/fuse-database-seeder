<nav x-data="{ open: false }" class="bg-blue-300 border-b text-white border-gray-100">
    <!-- facilitator Navigation Menu -->
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        <div class="flex justify-between h-16">
            <div class="flex">

                <!-- Navigation Links -->
                <x-fac-nav-link route="facilitator.activity">
                  {{ __('Studio Activity') }}
                </x-fac-nav-link>
                <x-fac-nav-link route="facilitator.people">
                  {{ __('People') }}
                </x-fac-nav-link>
                <x-fac-nav-link route="facilitator.challenges">
                  {{ __('Challenges') }}
                </x-fac-nav-link>
                <x-fac-nav-link route="facilitator.comments">
                  {{ __('Comments') }}
                </x-fac-nav-link>
                <x-fac-nav-link route="facilitator.settings">
                  {{ __('Settings') }}
                </x-fac-nav-link>
                <x-fac-nav-link route="facilitator.announcements">
                  {{ __('Announcements') }}
                </x-fac-nav-link>
            </div>
         </div>
    </div>
</nav>