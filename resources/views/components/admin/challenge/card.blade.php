@props(['challenge'])

<div class="bg-gray-200 rounded-md p-2 mb-2">
    <div class="pl-2">
        <div class="flex">
            <a class="flex font-bold text-2xl" href="{{ route('admin.challenges.edit', $challenge->id) }}">
                {{ $challenge->name }}
                <x-icon icon="edit" width=25 height=25 class="inline ml-2 text-fuse-teal-dk" />
            </a>
            <form class="inline" method="post" action="{{ route('admin.challenges.destroy', $challenge->id) }}">
                @method('delete')
                @csrf
                <button>
                    <x-icon icon="trash" width=25 height=25 class="inline ml-2 text-fuse-teal-dk" />
                </button>
            </form>
        </div>
        <details>
            <summary>{{ count($challenge->challengeVersions) }} version(s)</summary>
            <ul>
                @foreach ($challenge->challengeVersions as $version)
                <li>
                    <span class="flex">{{ $version->name }}
                        <a href="{{ route('admin.challengeversions.edit', $version->id) }}">
                            <x-icon icon="edit" width=18 height=18 class="ml-2 text-black" />
                        </a>
                        <form method="post" action="{{ route('admin.challengeversions.copy', $version) }}"
                            class="inline-block">
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
    </div>
</div>