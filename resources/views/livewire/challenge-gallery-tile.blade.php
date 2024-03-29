<div class="bg-white shadow-tile rounded-xl border border-gray-300">
    <div class="w-full relative rounded-lg p-4 text-left">
        <button wire:click="$set('showModalFlag', true)" class="w-full">
            <div class="w-full flex items-center justify-center aspect-video rounded-lg bg-fuse-teal-dk bg-cover"
                 style="background-image: url({{ $challengeVersion->gallery_thumbnail_url }})">
                <div class="gallery-play-border">
                    <div class="gallery-play-button">&nbsp;</div>
                </div>
            </div>
        </button>
        <x-progress-bar :user="$user" :interactive="true" :levelable="$challengeVersion" class="h-3" />
        <button wire:click="$set('showModalFlag', true)">
            <h4 class="font-semibold text-fuse-teal-dk text-xl m-0 text-left">
                {{ $challengeVersion->challenge->name }}
                <span class="uppercase text-sm font-light text-fuse-nav-blue">
                    {{ $challengeVersion->gallery_note }}
                </span>
            </h4>
            <div class="min-h-[4rem] text-left">
                {{ $challengeVersion->blurb }}
            </div>
        </button>
    </div>
    <x-jet-modal wire:model="showModalFlag">
        <div class="py-4 text-center text-fuse-teal-dk text-3xl whitespace-nowrap">
            @if ($level)
            <span class="tracking-tight mr-1">{{ __(':challenge Level :number', ['challenge' => $challengeVersion->challenge->name, 'number' => $level->level_number]) }}</span>
            @else
            <span class="tracking-tight mr-1">{{ __(':challenge', ['challenge' => $challengeVersion->challenge->name]) }}</span>
            @endif
            <button class="absolute right-0 top-0 mt-1 mr-1" wire:click="$toggle('showModalFlag')">
                <x-icon icon="x-circle" strokeWidth="1" width="30" height="30" />
            </button>
        </div>

        <div class="mx-4 mb-4 relative overflow-hidden">
            <div class="w-full bg-blue-200 rounded-lg">
                <x-wistia.inline :videoId="$challengeVersion->gallery_wistia_video_id" />
            </div>
        </div>

        <div class="text-right mx-4 mb-8">
            @if (! auth()->user()->canStartChallengeVersion($challengeVersion))
            <x-icon icon="lock" />
            {{ __('Complete :requirement to unlock', ['requirement' => $challengeVersion->challenge->prerequisiteChallenge->name]) }}
            @else
                @if ($continue)
                <a class="btn border rounded-xl uppercase p-2 text-xl font-bold text-slate-400" href="{{ route('student.level', ['challengeVersion' => $challengeVersion, 'level' => $level]) }}">{{ __('Continue') }}</a>
                @else
                <form action="{{ route('student.level_start', ['challengeVersion' => $challengeVersion, 'level' => $level]) }}" method="POST">
                @csrf
                <button class="border rounded-xl uppercase p-2 text-xl font-bold text-slate-400">{{ __('Start') }}</button>
                </form>
                @endif
            @endif
        </div>

    </x-jetmodal>
</div>

