<nav x-data="{ open: false }" class="bg-black border-b text-white border-gray-100">
    <!-- Admin Navigation Menu -->
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        <div class="flex justify-between h-8">
            <div class="flex">

                <!-- Navigation Links -->
                <div class="hidden space-x-8 sm:-my-px sm:ml-10 sm:flex">
                    <x-nav.link href="{{ route('admin.packages.index') }}" :active="request()->routeIs('admin.packages.index')">
                        {{ __('Packages') }}
                    </x-nav.link>
                </div>
                <div class="hidden space-x-8 sm:-my-px sm:ml-10 sm:flex">
                    <x-nav.link href="{{ route('admin.districts.index') }}" :active="request()->routeIs('admin.challenges.index')">
                        {{ __('Districts') }}
                    </x-nav.link>
                </div>
                <div class="hidden space-x-8 sm:-my-px sm:ml-10 sm:flex">
                    <x-nav.link href="{{ route('admin.schools.index') }}" :active="request()->routeIs('admin.schools.index')">
                        {{ __('Schools') }}
                    </x-nav.link>
                </div>
                <div class="hidden space-x-8 sm:-my-px sm:ml-10 sm:flex">
                    <x-nav.link href="{{ route('admin.studios.index') }}" :active="request()->routeIs('admin.studios.index')">
                        {{ __('Studios') }}
                    </x-nav.link>
                </div>
                <div class="hidden space-x-8 sm:-my-px sm:ml-10 sm:flex">
                    <x-nav.link href="{{ route('admin.challenges.index') }}" :active="request()->routeIs('admin.challenges.index')">
                        {{ __('Challenges') }}
                    </x-nav.link>
                </div>
                <div class="hidden space-x-8 sm:-my-px sm:ml-10 sm:flex">
                    <x-nav.link href="{{ route('admin') }}" :active="request()->routeIs('admin')">
                        {{ __('Administrivia') }}
                    </x-nav.link>
                </div>
            </div>
         </div>
    </div>
</nav>