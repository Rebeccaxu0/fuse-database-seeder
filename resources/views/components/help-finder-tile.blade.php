<div class="shadow-tile w-full relative rounded-lg p-4 text-left bg-white">
    <div class="aspect-video w-full rounded-lg flex items-center justify-items-center bg-gradient-to-t from-fuse-teal to-fuse-teal-dk-800">
      {{-- NO WAR --}}
    </div>
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

