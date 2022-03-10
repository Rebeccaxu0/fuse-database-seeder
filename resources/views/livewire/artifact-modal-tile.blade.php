<div>
    <div wire:click="$set('showModalFlag', true)"
      class="relative cursor-pointer border rounded-lg p-4 aspect-[17/14] shadow-lg">
      <div class="aspect-video bg-blue-200">Preview Image</div>
      <div>
        <span class="text-slate-500 uppercase">{{ $timeAgo }} ({{ $artifact->created_at->format('Y-m-d') }})</span>
        {{-- @if ($comments) --}}
        <span class="float-right flex items-center"><x-icon icon="comment" strokeWidth="1.5" class="text-slate-500" />{{ $commentCount }}</span>
        {{-- @endif --}}
      </div>
      <div class="text-right uppercase text-slate-500 font-bold">
        {{ $artifact->name }}
      </div>
      <div class="text-right uppercase font-bold">
        {{ $title }}
      </div>
      <div class="absolute bottom-0 left-0 m-4 flex items-center">
        @if ($parent->type == 'idea')
            <x-icon icon="idea" viewBox="60.4 90.6" fill="currentColor" alt="{{ __('complete') }}" class="text-orange-500"/>
        @else
            <span class="text-blue-400 text-2xl font-bold">{{ __('L:number', ['number' => $parent->level_number]) }}</span>
        @endif

        @if ($artifact->type == 'complete')
            <x-icon icon="complete" alt="{{ __('complete') }}" class="text-blue-400"/>
        @else
            <x-icon icon="save" alt="{{ __('save') }}" class="text-blue-400"/>
        @endif
      </div>
    </div>
    <x-jet-dialog-modal wire:model="showModalFlag">
        <x-slot name="title">
          <span class="font-bold">{{ $title }}</span> <span>{{ $title_modifier }}</span>
        </x-slot>

        <x-slot name="content">
          Big time
        </x-slot>

        <x-slot name="footer">
          @if ($artifact->type == 'complete')
            <x-icon icon="complete" alt="{{ __('complete') }}" class="text-green-500"/>
          @else
            Save Icon
          @endif

          {{-- TODO: test if an artifact is downloadable --}}
          @if (true)
          <a href='' download="{{ $artifact->filename }}">
            <x-icon icon="download" alt="{{ __('download') }}" class="text-green-500"/>
          </a>
          @endif

          Team information

          <span class="uppercase">{{ $timeAgo }}</span> ({{ $artifact->created_at->format('Y-m-d') }})

          <div class="font-bold">
            <div>{{ $artifact->name }}</div>
            <div>
              <a href="{{ route('student.level', [$level->challengeVersion, $level]) }}">{{ $title_modifier }}</a> | {{ $title }}
            </div>
          </div>
        </x-slot>
    </x-jet-dialog-modal>
</div>

