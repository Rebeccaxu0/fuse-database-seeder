<x-app-layout>

    <x-slot name="title">Seekrit</x-slot>

    <x-slot name="header">Seekrit</x-slot>

    <div class="md:grid md:grid-cols-2 lg:gr-cols-3 gap-2">

        <fieldset class="border p-2">
            <legend class="font-bold">One Time, One Time</legend>
            <ul><li><a href="{{ route('admin.seekrit.videotag') }}">Update Video Tag in Level Pages</a></li></ul>
            <ul><li><a href="{{ route('admin.seekrit.popups') }}">Update Help Article Popups in Level Pages</a></li></ul>
        </fieldset>
        
    </div>

</x-app-layout>
