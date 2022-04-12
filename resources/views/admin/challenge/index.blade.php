<x-app-layout>

    <x-slot name="title">{{ __('Challenges') }}</x-slot>

    <x-slot name="header">{{ __('Challenges') }}</x-slot>

    <a href="{{ route('admin.challenges.create') }}">
        <button class="text-md h-12 px-6 m-2 bg-fuse-green rounded-lg text-white">Add challenge</button>
    </a>
    <table class="min-w-full min-h-full leading-normal">
        <thead>
            <tr>
                <th scope="col" class="px-5 py-3 bg-white border-b border-gray-200 text-left text-black bold">
                    {{ __('Challenge') }}
                </th>
                <th scope="col" class="ml-6 px-5 py-3 bg-white border-b border-gray-200 text-left text-black bold">
                </th>
            </tr>
        </thead>
        <tbody>
            @foreach ($challenges as $challenge)
            <tr>
                <td class="border-gray-200 bg-white text-sm">
                    <div class="flex items-center">
                        <div class="flex-shrink-0">
                        </div>
                        <div class="flex ml-3">
                            <a href="{{ route('admin.challenges.edit', $challenge->id) }}">
                                {{ $challenge->name }}
                            </a>
                            <p class="text-gray-900 ml-5 whitespace-no-wrap">
                            <details>
                                <summary>{{ __(':count version(s)', ['count' => count($challenge->challengeVersions)]) }}</summary>
                                <ul>
                                    @foreach ($challenge->challengeVersions as $version)
                                    <li>
                                        <span class="flex text-xs">{{ $version->name }}
                                            <a href="{{ route('admin.challengeversions.edit', $version->id) }}">
                                                <x-icon icon="edit" width=18 height=18 class="ml-2 text-black" />
                                            </a>
                                            <a href="{{ route('admin.challengeversions.destroy', $version->id) }}">
                                                <x-icon icon="trash" width=18 height=18 class="ml-2 text-black" />
                                            </a>
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
                </td>
                <td class="border-gray-200 bg-white">
                    <div class="flex">
                        <a href="{{ route('admin.challenges.edit', $challenge->id) }}">
                            <x-icon icon="edit" width=25 height=25 class="ml-2 text-black" />
                        </a>
                        <a href="{{ route('admin.challenges.destroy', $challenge->id) }}">
                            <x-icon icon="trash" width=25 height=25 class="ml-2 text-black" />
                        </a>
                    </div>
                </td>
            </tr>
            @endforeach
        </tbody>
    </table>
</x-app-layout>