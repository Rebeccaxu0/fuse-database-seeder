<x-app-layout>

    <x-slot name="title">Administrivia</x-slot>

    <x-slot name="header">ADMIN</x-slot>

    <div class="md:grid md:grid-cols-2 lg:gr-cols-3 gap-2">
        <fieldset class="border p-2">
            <legend class="font-bold">Challenges & Levels</legend>
            <ul>
                <li><a href="{{ route('admin.challenges.index') }}">Meta Challenges</a></li>
                <li><a href="{{ route('admin.challengeversions.index') }}">Challenges</a></li>
                <li><a href="{{ route('admin.levels.index') }}">Levels</a></li>
                <li><a href="{{ route('admin.helparticles.index') }}">Level Help Articles</a></li>
            </ul>
        </fieldset>

        <fieldset class="border p-2">
            <legend class="font-bold">Districts, Schools, Studios, Users</legend>
            <ul>
                <li><a href="{{ route('admin.districts.index') }}">Districts</a></li>
                <li><a href="{{ route('admin.schools.index') }}">Schools</a></li>
                <li><a href="{{ route('admin.studios.index') }}">Studios</a></li>
                <li><a href="{{ route('admin.users.index') }}">Users</a></li>
            </ul>
        </fieldset>

        <fieldset class="border p-2">
            <legend class="font-bold">Other</legend>
            <ul>
                <li><a href="{{ route('admin.packages.index') }}">Packages</a></li>
                <li><a href="{{ route('admin.media.index') }}">Files</a></li>
                <li><a href="{{ route('admin.announcements.index') }}">Announcements</a></li>
                <li><a href="{{ route('admin.ltiplatforms.index') }}">LTI</a></li>
                <li><a href="{{ route('admin.cache.clearall') }}">Clear Cache</a></li>
            </ul>
        </fieldset>
    </div>

</x-app-layout>
