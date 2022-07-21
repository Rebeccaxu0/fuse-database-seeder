<div class="shadow-tile w-full relative rounded-lg p-4 text-left bg-white">
    <x-help-finder-tile-pane :challengeVersion="$challengeVersion" :studio="$studio" />
    <div class="mt-3 font-bold text-xl">
      {{ $challengeVersion->challenge->name }}
      <span class="uppercase text-sm font-light text-fuse-nav-blue">
        {{ $challengeVersion->gallery_note }}
      </span>
    </div>
    <div class="min-h-[4rem]">
      {{ $challengeVersion->blurb }}
    </div>
</div>

