<x-app-layout>

    <x-slot name="title">{{ __('Administrivia') }}</x-slot>

    <x-slot name="header">{{ __('ADMIN') }}</x-slot>

    <h2>{{ __('Common Tasks') }}</h2>

    <ul>
        <li><a href="{{ route('admin.users.index') }}">{{ __('Users') }}</a></li>
        <li><a href="{{ route('admin.challenges.index') }}">{{ __('Challenges') }}</a></li>
        <li><a href="{{ route('admin.levels.index') }}">{{ __('Levels') }}</a></li>
        <li><a href="{{ route('admin.districts.index') }}">{{ __('Districts') }}</a></li>
        <li><a href="{{ route('admin.schools.index') }}">{{ __('Schools') }}</a></li>
        <li><a href="{{ route('admin.studios.index') }}">{{ __('Studios') }}</a></li>
        <li><a href="{{ route('admin.packages.index') }}">{{ __('Packages') }}</a></li>
        <li><a href="{{ route('admin.media.index') }}">{{ __('Files') }}</a></li>
    </ul>

    <hr>

    <h2>{{ __('Uncommon Tasks') }}</h2>

    <ul>
      <li><a href="{{ route('admin.lti_platforms.index') }}">{{ __('LTI') }}</a></li>
      <li><a href="{{ route('admin.levels.index') }}">{{ __('Levels') }}</a></li>
    </ul>

</x-app-layout>
