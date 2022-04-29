<x-app-layout>

    <x-slot name="title">{{ __('Challenge Versions') }}</x-slot>

    <x-slot name="header">{{ __('Challenge Versions') }}</x-slot>

    <div class="md:grid md:grid-cols-2 xl:grid-cols-3 gap-4 mt-4">
        @foreach ($challengeversions as $challengeversion)
        <div class="bg-gray-200 rounded-md p-2 mb-2">
            <div class="float-left pl-2">
                <a href="{{ route('admin.challengeversions.edit', $challengeversion->id) }}">
                    <h4>{{ $challengeversion->name }}</h4>
                </a>
                <div class="flex">
                    <a href="{{ route('admin.challengeversions.edit', $challengeversion->id) }}">
                        <x-icon icon="edit" width=25 height=25 class="ml-2 text-black" />
                    </a>
                    <form method="post" action="{{ route('admin.challengeversions.destroy', $challengeversion->id) }}">
                        @method('delete')
                        @csrf
                        <button>
                            <x-icon icon="trash" width=25 height=25 class="ml-2 text-black" />
                        </button>
                    </form>
                </div>
                <p class="text-gray-900 ml-5 whitespace-no-wrap">
                <details>
                    <summary>{{ __(':count level(s)', ['count' => count($challengeversion->levels)]) }}</summary>
                    <ul>
                        @foreach ($challengeversion->levels as $level)
                        <li>
                            <span class="flex">{{ $challengeversion->name . ' ' . $level->level_number }}
                                <a href="{{ route('admin.levels.edit', $level->id) }}">
                                    <x-icon icon="edit" width=18 height=18 class="ml-2 text-black" />
                                </a>
                                <form method="post" action="{{ route('admin.levels.copy', $level) }}" class="inline-block">
                                    @csrf
                                    <button>
                                        <x-icon icon="copy" width=25 height=25 class="ml-2 text-black" />
                                    </button>
                                </form>
                            </span>
                        </li>
                        @endforeach
                    </ul>
                    <a href="{{ route('admin.levels.create') }}">
                        <button class="text-sm h-6 px-2 m-2 bg-fuse-green rounded-lg text-white">add level</button>
                    </a>
                </details>
                </p>
            </div>
        </div>
        @endforeach
    </div>
</x-app-layout>