@php
use App\Enums\ChallengeStatus as Status;
@endphp

<x-app-layout>

    <x-slot name="title">{{ __('My Challenge Management') }}</x-slot>
    <x-slot name="header">{{ __('My Challenge Management') }}</x-slot>

    @if (! $studio->deFactoPackage)
        <h2>{{ __('Your studio is misconfigured and we cannot show challenges. Please contact FUSE.') }}</h2>
    @else
    <div class="md:columns-2 lg:container md:gap-12">
        @foreach ($challengeCategories->sortBy('id') as $category)
            <div class="py-4 px-4 break-inside-avoid">
                <h2 class="mt-0 text-left text-black">{{ $category->name }}</h2>
                <p class="text-sm text-black">{{ $category->description }}</p>
                @foreach ($category->cvlist as $challengeVersion)
                    @if ($challengeVersion->status == Status::Current)
                    <div class="flex items-center mb-2 relative break-inside-avoid">
                        @livewire ('studio-challenge-toggle', ['studio' => $studio, 'challengeVersion' => $challengeVersion], key("{$studio->id}-{$challengeVersion->id}"))
                        <div class="inline-block border border-gray-400 rounded-lg py-2 pl-8 pr-1"
                            style="width: calc(100% - 3.5rem)" title="{{ $challengeVersion->challenge->name }}">
                            {{ $challengeVersion->name }}
                            <a class="border border-fuse-teal-500 rounded-xl mx-4 inline-block h-6 w-6 float-right text-center"
                                href="{{ $challengeVersion->info_article_url }}" title="info" alt="info"
                                target="_blank">i</a>
                        </div>
                    </div>
                    @endif
                @endforeach
            </div>
        @endforeach
    </div>

    <hr class="my-4">

    <div class="md:columns-2 lg:container md:gap-12">
        <div class="py-4 px-4 break-inside-avoid">
            <h2 class="mt-0 text-left text-black">{{ Status::Legacy->label() }}</h2>
            <p class="text-sm text-black">{{ Status::Legacy->description() }}</p>
            @foreach ($legacyChallenges->sortBy('challenge.name') as $challengeVersion)
                <div class="flex items-center mb-2 relative break-inside-avoid">
                    @livewire ('studio-challenge-toggle', ['studio' => $studio, 'challengeVersion' => $challengeVersion], key("{$studio->id}-{$challengeVersion->id}"))
                    <div class="inline-block ml-2 border border-gray-400 rounded-lg py-2 pl-8 pr-1"
                        style="width: calc(100% - 3.5rem)">
                        {{ $challengeVersion->name }}
                        <a class="border border-fuse-teal-500 rounded-xl mx-4 inline-block h-6 w-6 float-right text-center"
                            href="{{ $challengeVersion->info_article_url }}" title="info" alt="info"
                            target="_blank">i</a>
                    </div>
                </div>
            @endforeach
        </div>
        <div class="py-4 px-4 break-inside-avoid">
            <h2 class="mt-0 text-left text-black">{{ Status::Beta->label() }}</h2>
            <p class="text-sm text-black">{{ Status::Beta->description() }}</p>
            @foreach ($betaChallenges->sortBy('challenge.name') as $challengeVersion)
                <div class="flex items-center mb-2 relative break-inside-avoid">
                    @livewire ('studio-challenge-toggle', ['studio' => $studio, 'challengeVersion' => $challengeVersion], key("{$studio->id}-{$challengeVersion->id}"))
                    <div class="inline-block ml-2 border border-gray-400 rounded-lg py-2 pl-8 pr-1"
                        style="width: calc(100% - 3.5rem)">
                        {{ $challengeVersion->name }}
                        <a class="border border-fuse-teal-500 rounded-xl mx-4 inline-block h-6 w-6 float-right text-center"
                            href="{{ $challengeVersion->info_article_url }}" title="info" alt="info"
                            target="_blank">i</a>
                    </div>
                </div>
            @endforeach
        </div>
    </div>
    @endif

</x-app-layout>
