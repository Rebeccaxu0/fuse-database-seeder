<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('ADMIN') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-xl sm:rounded-lg">
              <h2>{{ __('Common Tasks') }}</h2>
              <ul>
                <li><a href="{{ route('admin.challenges.index') }}">Challenges</a></li>
                <li><a href="{{ route('admin.districts.index') }}">Districts</a></li>
                <li><a href="{{ route('admin.schools.index') }}">Schools</a></li>
                <li><a href="{{ route('admin.studios.index') }}">Studios</a></li>
                <li><a href="{{ route('admin.packages.index') }}">Packages</a></li>
              </ul>
              <hr>
              <h2>{{ __('Uncommon Tasks') }}</h2>
              <ul>
                <li><a href="{{ route('admin.lti_platforms.index')}}">LTI</a></li>
              </ul>
            </div>
        </div>
    </div>
</x-app-layout>
