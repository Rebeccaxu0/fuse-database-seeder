<x-admin-layout>

  <x-slot name="title">{{ __('Administrivia') }}</x-slot>

  <x-slot name="header">{{ __('ADMIN') }}</x-slot>

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

</x-admin-layout>
