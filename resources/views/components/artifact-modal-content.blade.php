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
            {{ __('Submitted by :team', ['team' => $teamnames]) }}<br/>
            <span class="uppercase">{{ $timeAgo }}</span>
            ({{ $artifact->created_at->format('Y-m-d') }})
        </div>

        @if ($comments)
        <div class="absolute right-[1rem]">
            <livewire:comment-count :artifact="$artifact" :user="auth()->user()" />
        </div>
        @endif
    </div>

    <div class="uppercase font-medium clear-both">
        <div>{{ $artifact->name }}</div>
        <div>
            @if ($idea)
            <a href="{{ $levelRoute }}">{{ $title }}</a> | {{ __('My Idea') }}
            <div>{{ __('Inspiration: :inspiration', ['inspiration' => $inspiration])}}</div>
            @else
            <a href="{{ $levelRoute }}">{{ $title_modifier }}</a> | {{ $title }}</a>
            @endif
        </div>
    </div>
    @if ($related->count())
    <div class="uppercase font-semibold">
        {!! __('Saves &amp; completes from this level') !!}
    </div>
    <ul>
        @foreach ($related as $artifact)
        <li>
            {{ $artifact->name }}
        </li>
        @endforeach
    </ul>
    @endif
</div>

@if ($comments)
<livewire:artifact-comment-thread :artifact="$artifact" :user="auth()->user()" />
</div>
@endif
