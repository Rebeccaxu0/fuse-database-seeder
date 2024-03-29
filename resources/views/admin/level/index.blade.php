<x-app-layout>

    <x-slot name="title">Levels</x-slot>

    <x-slot name="header">Levels</x-slot>

    <x-admin.challenge-subnav />

    <a href="{{ route('admin.levels.create') }}">
        <button class="text-md h-12 px-6 m-2 mb-6 bg-fuse-green rounded-lg text-white">Add level</button>
    </a>

    <div class="md:grid md:grid-cols-2 xl:grid-cols-4 gap-6">
        @foreach ($levels as $level)
        <div class="bg-gray-200 rounded-md p-2 mb-2">
            <div class="float-left pl-2">
                @if ($level->levelable)
                <h4 class="mt-2 mb-2"> {{ $level->levelable->name . ' ' . $level->level_number }} </h4>
                @else
                <h1>ORPHAN</h1>
                @endif
                <span class="flex pl-2">
                    <a href="{{ route('admin.levels.edit', $level->id) }}">
                        <x-icon icon="edit" width=25 height=25 class="ml-2 text-black" />
                    </a>
                    <form method="post" action="{{ route('admin.levels.copy', $level) }}" class="inline-block">
                        @csrf
                        <button>
                        <x-icon icon="copy" width=25 height=25 class="ml-2 text-black" />
                        </button>
                    </form>
                </span>
            </div>
        </div>
        @endforeach

</x-app-layout>
