<div class="relative">
    <input id="school_district_search" name="school_district_search" type="text"
        class="form-input mt-1 block w-full rounded" placeholder="{!! __('Search schools or districts&hellip;') !!}" value="{{ $query }}"
        wire:keydown.enter.prevent="" wire:model.debounce.300ms="query" />
    <div wire:loading class="absolute z-10 w-full bg-white shadow-lg">
        <div class="list-item">{!! __('Searching&hellip;') !!}</div>
    </div>

    @if (!empty($query))
        <div class="relative top-0 bottom-0 left-0 right-0"></div>

        <div class="relative z-10 w-full bg-white rounded-t-none shadow-lg list-group">
            @forelse ($schools as $school)
                <div class="mb-6">
                    <button wire:click="selectSchool({{ $school->id }})">
                        {{ $school->name }}
                        [{{ $school->district ? $school->district->name : __('<No District>') }}]
                    </button>
                </div>
            @empty
                <div>No results</div>
            @endforelse
        </div>
    @endif
</div>
