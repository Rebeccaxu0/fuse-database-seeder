<x-app-layout>

    <x-slot name="title">Help Articles</x-slot>

    <x-slot name="header">Help Articless</x-slot>

    <x-admin.challenge-subnav />

    <a href="{{ route('admin.helparticles.create') }}">
        <button class="text-md h-12 px-6 m-2 mb-6 bg-fuse-green rounded-lg text-white">Add Help Article</button>
    </a>

    <div class="md:grid md:grid-cols-2 xl:grid-cols-4 gap-6">
        @foreach ($helpArticles as $helpArticle)

        <div class="bg-gray-200 rounded-md p-2 mb-2">
            <h4 class="mt-2 mb-2">
                <a href="{{ route('admin.helparticles.edit', $helpArticle->id) }}" class="float-left">
                    {{ $helpArticle->name }} ({{ $helpArticle->id }})
                    <x-icon icon="edit" width=25 height=25 class="inline ml-2 text-black" />
                </a>
                <form method="post" action="{{ route('admin.helparticles.destroy', $helpArticle->id) }}" class="float-right">
                    @method('delete')
                    @csrf
                    <button class="inline">
                        <x-icon icon="trash" width=25 height=25 class="inline ml-2 text-black" />
                    </button>
                </form>
            </h4>
            <div class="clear-both pt-4">
                {{ str($helpArticle->body)->limit(30) }}
                {{-- @if (! $helpArticle->levels)
                <h1>ORPHAN</h1>
                @else
                <div class="font-semibold">
                Linked to levels:
                </div>
                @foreach ($helpArticle->levels as $level)
                <a href="{{ route('admin.levels.edit', $level) }}">{{ $level->levelable->name }} L{{ $level->level_number }}</a> |
                @endforeach
                @endif --}}
            </div>
        </div>

        @endforeach

</x-app-layout>
