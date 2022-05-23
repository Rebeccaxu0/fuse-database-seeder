@if ($comments)
<div class="grid grid-cols-[2fr_1fr]">
@endif

<div class="px-4 pb-4 relative">
    <div class="aspect-video w-full bg-blue-200 rounded-lg">
      Big time
    </div>

    <div class="py-2 flex items-center">
        <x-icon icon="{{ $artifact->type }}"
                alt="{{ __($artifact->type) }}"
                height=30 width=30 class="text-fuse-teal-dk-500"/>
        {{-- TODO: test if an artifact is downloadable --}}
        @if (true)
        <a href='' download="{{ $artifact->filename }}">
            <x-icon icon="download" alt="{{ __('download') }}" class="text-green-500"/>
        </a>
        @endif

        <div class="inline-block ml-3">
            Team information<br>
            <span class="uppercase">{{ $timeAgo }}</span>
            ({{ $artifact->created_at->format('Y-m-d') }})
        </div>

        @if ($comments)
        <div class="absolute right-[1rem]">
            <livewire:comment-count :artifact="$artifact" />
        </div>
        @endif
    </div>

    <div class="font-medium clear-both">
        <div>{{ $artifact->name }}</div>
        <div>
          <a href="{{ $levelRoute }}">{{ $title_modifier }}</a> | {{ $title }}
        </div>
    </div>
</div>

@if ($comments)
<livewire:artifact-comment-thread :artifact="$artifact" :user="auth()->user()" />
</div>
@endif
