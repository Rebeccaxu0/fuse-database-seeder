<x-app-layout>

    <x-slot name="title">Challenges</x-slot>

    <x-slot name="header">Challenges</x-slot>

    <x-admin.challenge-subnav />

    @foreach ($categories as $category)
    @if ($category->disapproved)
    <details>
        <summary>
            {{ $category->name }}
        </summary>
    @else
    <h2>{{ $category->name }}</h2>
    @endif
    <div class="md:grid md:grid-cols-2 xl:grid-cols-3 gap-4 mt-4">
        @foreach ($category->challengeVersions->sortBy('name') as $challengeVersion)
        <div class="bg-gray-200 rounded-md p-2 mb-2">
            <div class="pl-2">
                <div class="flex">
                    <a class="flex font-bold text-2xl" href="{{ route('admin.challengeversions.edit', $challengeVersion->id) }}">
                        {{ $challengeVersion->name }}
                        <x-icon icon="edit" width=25 height=25 class="inline ml-2 text-fuse-teal-dk" />
                    </a>
                    <form class="inline" method="post" action="{{ route('admin.challengeversions.destroy', $challengeVersion->id) }}">
                        @method('delete')
                        @csrf
                        <button>
                            <x-icon icon="trash" width=25 height=25 class="inline ml-2 text-fuse-teal-dk" />
                        </button>
                    </form>
                </div>
                <p class="text-gray-900 ml-5 whitespace-no-wrap">
                <details>
                    <summary>{{ count($challengeVersion->levels) }} level(s)</summary>
                    <ol class="list-decimal">
                        @foreach ($challengeVersion->levels->sortBy('level_number') as $level)
                        <li class="list-decimal my-0">
                            <span class="flex">
                                <a title="edit" href="{{ route('admin.levels.edit', $level->id) }}">
                                    {{ strip_tags(str()->words($level->blurb, 5)) }}
                                    <x-icon icon="edit" width=18 height=18 class="inline ml-2 text-black" />
                                </a>
                            <form method="post" action="{{ route('admin.levels.copy', $level) }}" class="inline-block">
                                @csrf
                                <button title="copy">
                                    <x-icon icon="copy" width=18 height=18 class="ml-2 text-black" />
                                </button>
                            </form>
                            </span>
                        </li>
                        @endforeach
                    </ol>
                    <a href="{{ route('admin.levels.create', ['challengeVersion' => $challengeVersion->id]) }}">
                        <button class="text-sm h-6 px-2 m-2 bg-fuse-green rounded-lg text-white">add level</button>
                    </a>
                </details>
                </p>
            </div>
        </div>
        @endforeach
    </div>
    @if ($category->disapproved)
    </details>
    @endif
    @endforeach
</x-app-layout>
