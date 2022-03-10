<div>
    <div wire:click="$set('showModalFlag', true)"
      class="relative cursor-pointer rounded-lg p-4 aspect-[17/14] shadow-tile">
      <div class="aspect-video bg-blue-200 w-full">Preview Image</div>
      <div>
        <span class="text-slate-500 uppercase">{{ $timeAgo }} ({{ $artifact->created_at->format('Y-m-d') }})</span>
        @if ($comments)
        <span class="float-right flex items-center font-bold"><x-icon icon="comment" strokeWidth="1.5" class="text-slate-500" />{{ $commentCount }}</span>
        @endif
      </div>
      <div class="text-right uppercase text-slate-500 font-bold">
        {{ $artifact->name }}
      </div>
      <div class="text-right uppercase font-bold">
        {{ $title }}
      </div>
      <div class="absolute bottom-0 left-0 m-4 flex items-center">
        @if ($parent->type == 'idea')
            <x-icon icon="idea" viewBox="60.4 90.6" fill="currentColor" alt="{{ __('idea') }}" class="text-orange-500"/>
        @else
            <span class="text-blue-400 text-2xl font-bold">{{ __('L:number', ['number' => $parent->level_number]) }}</span>
        @endif

          <x-icon icon="{{ $artifact->type }}" alt="{{ __($artifact->type) }}" class="text-fuse-teal-dk-500"/>
        </div>
    </div>
    <x-jet-modal wire:model="showModalFlag">
        <div class="py-4 text-center text-fuse-teal-dk text-3xl whitespace-nowrap">
            <span class="tracking-tight mr-1">{{ $title }}</span> <span class="font-light">{{ $title_modifier }}</span>
            <button class="absolute right-0 top-0 -mt-1" wire:click="$set('showModalFlag', false)">
              <x-icon icon="x-circle" strokeWidth="1" width="30" height="30" />
            </button>
        </div>

        @if ($comments)
        <div class="grid grid-cols-[2fr_1fr]">
        @endif

        <div class="px-4 pb-4 relative">
            <div class="aspect-video w-full bg-blue-200 rounded-lg">
              Big time
            </div>

            <div class="py-2 flex items-center">
                <x-icon icon="{{ $artifact->type }}" alt="{{ __($artifact->type) }}"
                  height=30 width=30 class="text-fuse-teal-dk-500"/>
                {{-- TODO: test if an artifact is downloadable --}}
                @if (true)
                <a href='' download="{{ $artifact->filename }}">
                  <x-icon icon="download" alt="{{ __('download') }}" class="text-green-500"/>
                </a>
                @endif

                  <div class="inline-block ml-3">
                    Team information<br>
                    <span class="uppercase">{{ $timeAgo }}</span> ({{ $artifact->created_at->format('Y-m-d') }})
                  </div>

                @if ($comments)
                <span class="absolute right-[1rem] flex items-center font-bold">
                    <x-icon icon="comment" strokeWidth="1.5" class="text-slate-500" /> {{ $commentCount }}
                </span>
                @endif
            </div>

            <div class="font-medium clear-both">
                <div>{{ $artifact->name }}</div>
                <div>
                    <a href="{{ route('student.level', [$level->challengeVersion, $level]) }}">{{ $title_modifier }}</a> | {{ $title }}
                </div>
            </div>
        </div>

        @if ($comments)
        <div class="border-l p-2 float-right height-full">
          <div class="uppercase font-medium text-lg">{{ __('Add Comment') }}</div>
          <textarea id="comment" name="comment" placeholder="{{ __('Write your comment here...')}}"></textarea>
        </div>
        </div>
        @endif

    </x-jetmodal>
</div>

