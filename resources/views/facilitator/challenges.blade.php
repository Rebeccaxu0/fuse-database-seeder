<x-app-layout>

    <h2 class="mt-0 mb-12">{{ __('My Challenge Management') }}</h2>

    <div class="md:columns-2 md:gap-12">
        @foreach ($challengeCategories as $category)
            <div class="py-4 px-16 break-inside-avoid">
                <h2 class="mt-0 text-left text-black">{{ $category->name }}</h2>
                <p class="text-sm text-black">{{ $category->description }}</p>
                @foreach ($challenges as $challenge)
                    @foreach ($challenge->challengeVersions as $challengeVersion)
                        @if ($challengeVersion->challengeCategory == $category)
                            <div class="mb-2 relative break-inside-avoid">
                                <div class="bg-slate-500 absolute top-0 w-14 h-7">
                                    {{-- TODO: replace with livewire toggle component --}}
                                    {{ in_array($challengeVersion->id, $activeChallenges) ? 't' : 'f' }}
                                </div>
                                <div class="border border-gray-400 rounded-lg ml-14 py-2 pl-8 pr-1"
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
