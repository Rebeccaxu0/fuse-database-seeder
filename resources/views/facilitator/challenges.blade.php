<x-app-layout>

    <x-slot name="title">{{ __('My Challenge Management') }}</x-slot>
    <x-slot name="header">{{ __('My Challenge Management') }}</x-slot>

    <div class="md:columns-2 md:gap-12">
        @foreach ($primaryChallengeCategories as $category)
            <div class="py-4 px-4 break-inside-avoid">
                <h2 class="mt-0 text-left text-black">{{ $category->name }}</h2>
                <p class="text-sm text-black">{{ $category->description }}</p>
                @foreach ($challenges as $challenge)
                    @foreach ($challenge->challengeVersions as $challengeVersion)
                        @if ($challengeVersion->challengeCategory == $category)
                            <div class="flex items-center mb-2 relative break-inside-avoid">
                                <livewire:studio-challenge-toggle :studio="$studio" :challengeVersion="$challengeVersion" >
                                <div class="inline-block border border-gray-400 rounded-lg py-2 pl-8 pr-1"
                                    style="width: calc(100% - 3.5rem)">
                                    {{ $challengeVersion->name }}
                                    <a class="border border-fuse-teal-500 rounded-xl mx-4 inline-block h-6 w-6 float-right text-center"
                                        href="{{ $challengeVersion->info_article_url }}" title="info" alt="info"
                                        target="_blank">i</a>
                                </div>
                            </div>
                        @endif
                    @endforeach
                @endforeach
            </div>
        @endforeach
    </div>

    <hr class="my-4">

    <div class="md:columns-2 md:gap-12">
        @foreach ($secondaryChallengeCategories as $category)
            <div class="py-4 px-4 break-inside-avoid">
                <h2 class="mt-0 text-left text-black">{{ $category->name }}</h2>
                <p class="text-sm text-black">{{ $category->description }}</p>
                @foreach ($challenges as $challenge)
                    @foreach ($challenge->challengeVersions as $challengeVersion)
                        @if ($challengeVersion->challengeCategory == $category)
                            <div class="flex items-center mb-2 relative break-inside-avoid">
                                <livewire:studio-challenge-toggle :studio="$studio" :challengeVersion="$challengeVersion" >
                                <div class="inline-block ml-2 border border-gray-400 rounded-lg py-2 pl-8 pr-1"
                                    style="width: calc(100% - 3.5rem)">
                                    {{ $challengeVersion->name }}
                                    <a class="border border-fuse-teal-500 rounded-xl mx-4 inline-block h-6 w-6 float-right text-center"
                                        href="{{ $challengeVersion->info_article_url }}" title="info" alt="info"
                                        target="_blank">i</a>
                                </div>
                            </div>
                        @endif
                    @endforeach
                @endforeach
            </div>
        @endforeach
    </div>

</x-app-layout>

