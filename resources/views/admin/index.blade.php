<x-app-layout>

    <x-slot name="title">{{ __('Administrivia') }}</x-slot>

    <x-slot name="header">{{ __('ADMIN') }}</x-slot>

    <div class="md:grid md:grid-cols-2 lg:gr-cols-3 gap-2">
        <fieldset class="grid gap-x-4 grid-cols-2 md:grid-cols-3 border p-2">
            <legend class="font-bold">{{ __('Challenges & Levels') }}</legend>
            <ul>
                <li><a href="{{ route('admin.challenges.index') }}">{{ __('Meta Challenges') }}</a></li>
                <li><a href="{{ route('admin.challengeversions.index') }}">{{ __('Challenges') }}</a></li>
                <li><a href="{{ route('admin.levels.index') }}">{{ __('Levels') }}</a></li>
            </ul>
        </fieldset>

        <fieldset class="grid gap-x-4 grid-cols-2 md:grid-cols-3 border p-2">
            <legend class="font-bold">{{ __('Districts, Schools, Studios, Users') }}</legend>
            <ul>
                <li><a href="{{ route('admin.districts.index') }}">{{ __('Districts') }}</a></li>
                <li><a href="{{ route('admin.schools.index') }}">{{ __('Schools') }}</a></li>
                <li><a href="{{ route('admin.studios.index') }}">{{ __('Studios') }}</a></li>
                <li><a href="{{ route('admin.users.index') }}">{{ __('Users') }}</a></li>
            </ul>
        </fieldset>

        <fieldset class="grid gap-x-4 grid-cols-2 md:grid-cols-3 border p-2">
            <legend class="font-bold">{{ __('Other') }}</legend>
            <ul>
                <li><a href="{{ route('admin.packages.index') }}">{{ __('Packages') }}</a></li>
                <li><a href="{{ route('admin.media.index') }}">{{ __('Files') }}</a></li>
                <li><a href="{{ route('admin.announcements.index') }}">{{ __('Announcements') }}</a></li>
                <li><a href="{{ route('admin.ltiplatforms.index') }}">{{ __('LTI') }}</a></li>
            </ul>
        </fieldset>
    </div>

</x-app-layout>
