<div class="p-4">
    <div class="pb-4 relative text-center text-fuse-teal-dk text-3xl whitespace-nowrap">
        @if ($artifact->level->levelable::class == App\Models\Idea::class)
        <span class="tracking-tight mr-1">{{ __('My Idea') }}</span> <span class="font-light">{{ $title }}</span>
        @else
        <span class="tracking-tight mr-1">{{ $title }}</span> <span class="font-light">{{ $title_modifier }}</span>
        @endif
        <button class="absolute right-0 top-0 -mt-1" wire:click="$set('showModalFlag', false)">
            <x-icon icon="x-circle" strokeWidth="1" width="30" height="30" />
        </button>
    </div>

@if ($comments)
<div class="grid grid-cols-[2fr_1fr]">
@endif

<div class="px-4 pb-4 relative">
    <div class="w-full bg-blue-200 rounded-lg">
        <x-artifact-image :artifact="$artifact" preview="0" />
    </div>

    <div class="py-2 flex items-center">
        <x-icon icon="{{ $artifact->type }}"
                alt="{{ __($artifact->type) }}"
                height=30 width=30 class="text-fuse-teal-dk-500"/>
        @if (! $artifact->url)
        <a href='{{ $downloadUrl }}' download="{{ $artifact->filename }}">
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
        @if ($artifact->url)
        <div>
            <a target="_blank" href="{{ $artifact->url }}">
                @if ($artifact->name)
                {{ $artifact->name }} ({{ $artifact->url }})
                @else
                {{ $artifact->url }}
                @endif
            </a>
        </div>
        @else
        <div>{{ $artifact->name }}</div>
        @endif
        <div>
            @if ($idea)
            <a href="{{ $levelRoute }}">{{ $title }}</a> | {{ __('My Idea') }}
            <div>{{ __('Inspiration: :inspiration', ['inspiration' => $inspiration]) }}</div>
            @else
            {{ $title }} <a href="{{ $levelRoute }}">{{ $title_modifier }}</a>
            @endif
        </div>
        @if ($artifact->notes)
        <div class="float-right">
            {{ $artifact->notes }}
        </div>
        @endif
    </div>
    {{-- @if ($related->count())
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
    @endif --}}
</div>

@if ($comments)
<livewire:artifact-comment-thread :artifact="$artifact" :user="auth()->user()" />
</div>
@endif

</div>
