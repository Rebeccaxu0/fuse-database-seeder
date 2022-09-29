@php
    use App\Enums\ChallengeStatus as Status;
@endphp

<x-app-layout>

    <x-slot name="title">Challenges</x-slot>

    <x-slot name="header">Challenges</x-slot>

    <x-admin.challenge-subnav />

    <fieldset class="border border-black rounded-lg p-3">
        <legend class="text-lg font-bold">Filter by status</legend>
        <a class="@if ($status == 'all') font-bold underline @else font-light @endif" href="{{ route('admin.challengeversions.index', ['show' => 'all']) }}">All</a> |
        <a class="@if ($status == 'beta') font-bold underline @else font-light @endif" href="{{ route('admin.challengeversions.index', ['show' => 'beta']) }}">Beta</a> |
        <a class="@if ($status == 'current') font-bold underline @else font-light @endif" href="{{ route('admin.challengeversions.index', ['show' => 'current']) }}">Current</a> |
        <a class="@if ($status == 'legacy') font-bold underline @else font-light @endif" href="{{ route('admin.challengeversions.index', ['show' => 'legacy']) }}">Legacy</a> |
        <a class="@if ($status == 'archive') font-bold underline @else font-light @endif" href="{{ route('admin.challengeversions.index', ['show' => 'archive']) }}">Archive</a>
    </fieldset>
    @if ($status == 'all')
    <fieldset class="border border-black border-2 rounded-lg p-3 max-w-sm grid gap-4 grid-cols-4">
        <legend class="text-lg font-bold">Legend</legend>
        <div class="rounded-md p-2 bg-gray-200 border-blue-700 border-4" id="tw-hint-beta">Beta</div>
        <div class="rounded-md p-2 bg-gray-200 border-gray-200 border-4" id="tw-hint-current">Current</div>
        <div class="rounded-md p-2 bg-gray-200 border-red-400 border-4" id="tw-hint-legacy">Legacy</div>
        <div class="rounded-md p-2 bg-red-400 border-red-400 border-4 text-white" id="tw-hint-archive">Archive</div>
    </fieldset>
    @endif
    @foreach ($categories as $category)
    <h2>{{ $category->name }}</h2>
    <div class="md:grid md:grid-cols-2 xl:grid-cols-3 gap-4 mt-4">
        @foreach ($category->cvlist->sortBy('name') as $challengeVersion)
        <div class="rounded-md p-2 mb-2 {{ $challengeVersion->cardClass }}">
            <div class="pl-2">
                <div class="flex">
                    <a class="flex font-bold text-2xl" href="{{ route('admin.challengeversions.edit', $challengeVersion->id) }}">
                        {{ $challengeVersion->name }}
                        @if ($challengeVersion->status != Status::Current) ({{ $challengeVersion->status->label() }}) @endif
                        <x-icon icon="edit" width=25 height=25 class="inline ml-2 text-fuse-teal-dk" />
                    </a>
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
    @endforeach
</x-app-layout>
