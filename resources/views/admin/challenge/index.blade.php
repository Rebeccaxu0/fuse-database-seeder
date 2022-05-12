<x-app-layout>

    <x-slot name="title">{{ __('Challenges') }}</x-slot>

    <x-slot name="header">{{ __('Challenges') }}</x-slot>

    <a href="{{ route('admin.challenges.create') }}">
        <button class="text-md h-12 px-6 m-2 bg-fuse-green rounded-lg text-white">Create challenge</button>
    </a>

    <div class="md:grid md:grid-cols-2 xl:grid-cols-3 gap-4 mt-4">
        @foreach ($challenges as $challenge)
        <div class="bg-gray-200 rounded-md p-2 mb-2">
            <div class="float-left pl-2">
                <a href="{{ route('admin.challenges.edit', $challenge->id) }}">
                    <h4>{{ $challenge->name }}</h4>
                </a>
                <div class="flex">
                    <a href="{{ route('admin.challenges.edit', $challenge->id) }}">
                        <x-icon icon="edit" width=25 height=25 class="ml-2 text-black" />
                    </a>
                    <form method="post" action="{{ route('admin.challenges.destroy', $challenge->id) }}">
                        @method('delete')
                        @csrf
                        <button>
                            <x-icon icon="trash" width=25 height=25 class="ml-2 text-black" />
                        </button>
                    </form>
                </div>
                <p class="text-gray-900 ml-5 whitespace-no-wrap">
                <details>
                    <summary>{{ __(':count version(s)', ['count' => count($challenge->challengeVersions)]) }}</summary>
                    <ul>
                        @foreach ($challenge->challengeVersions as $version)
                        <li>
                            <span class="flex">{{ $version->name }}
                                <a href="{{ route('admin.challengeversions.edit', $version->id) }}">
                                    <x-icon icon="edit" width=18 height=18 class="ml-2 text-black" />
                                </a>
                                <form method="post" action="{{ route('admin.challengeversions.copy', $version) }}" class="inline-block">
                                    @csrf
                                    <button>
                                        <x-icon icon="copy" width=18 height=18 class="ml-2 text-black" />
                                    </button>
                                </form>
                            </span>
                        </li>
                        @endforeach
                    </ul>
                    <a href="{{ route('admin.challengeversions.create', $challenge->id) }}">
                        <button class="text-sm h-6 px-2 m-2 bg-fuse-green rounded-lg text-white">add version</button>
                    </a>
                </details>
                </p>
            </div>
        </div>
        @endforeach
    </div>
</x-app-layout>
