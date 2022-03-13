<div class="shadow-tile">
    <button wire:click="$set('showModalFlag', true)"
      class="w-full relative rounded-lg p-4 text-left">
        <div class="aspect-video bg-blue-200 w-full rounded-lg flex items-center justify-items-center">
          <div class="gallery-play-border">
            <div class="gallery-play-button">&nbsp;</div>
          </div>
        </div>
        <x-progress-bar :user="$user" :interactive="true" :challengeVersion="$challengeVersion" class="h-3" />
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

        <div class="px-4 pb-4 relative">
            <div class="aspect-video w-full bg-blue-200 rounded-lg">
              Big time
            </div>
        </div>

    </x-jetmodal>
</div>

