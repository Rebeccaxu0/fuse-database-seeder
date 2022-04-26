<div class="bg-white shadow-tile">
    <button wire:click="$set('showModalFlag', true)"
            class="w-full relative rounded-lg p-4 text-left">
        <div class="relative aspect-video w-full rounded-lg flex items-center justify-items-center"
             {{-- NO WAR --}}
             style="background: linear-gradient(to bottom, #0057b7 50%, #FFD700 50%);">
            <div class="gallery-play-border">
                <div class="gallery-play-button">&nbsp;</div>
            </div>
            @if ($challengeVersion->firstMedia('gallery_preview'))
            <img class="absolute inset-0 rounded-lg" src="{{ $challengeVersion->firstMedia('gallery_preview')->getUrl() }}" />
            @endif
        </div>
        <x-progress-bar :user="$user" :interactive="true" :levelable="$challengeVersion" class="h-3" />
        <div class="font-bold text-xl">
            {{ $challengeVersion->challenge->name }}
            <span class="uppercase text-sm font-light text-fuse-nav-blue">
                {{ $challengeVersion->gallery_note }}
            </span>
        </div>
        <div class="min-h-[4rem]">
            {{ $challengeVersion->blurb }}
        </div>
    </button>
    <x-jet-modal wire:model="showModalFlag">
        <div class="py-4 text-center text-fuse-teal-dk text-3xl whitespace-nowrap">
            <span class="tracking-tight mr-1">{{ $challengeVersion->challenge->name }}</span>
            <button class="absolute right-0 top-0 -mt-1" wire:click="$set('showModalFlag', false)">
                <x-icon icon="x-circle" strokeWidth="1" width="30" height="30" />
            </button>
        </div>

        <div class="mx-4 mb-4 relative overflow-hidden">
            <div class="w-full bg-blue-200 rounded-lg">
                <x-wistia.inline :videoId="$challengeVersion->gallery_wistia_video_id" />
            </div>
        </div>

        <div class="text-right mx-4 mb-8">
            @if (auth()->user()->canStartChallengeVersion($challengeVersion))
            <button class="border rounded-xl uppercase p-2 text-xl font-bold text-slate-400">{{ __('Go to Level :number', ['number' => 1]) }}</button>
            @else
            <x-icon icon="lock" />
            {{ __('Complete :requirement to unlock', ['requirement' => $challengeVersion->prerequisiteChallengeVersion->challenge->name]) }}
            @endif
        </div>

    </x-jetmodal>
</div>
