<div>
    <x-slot name="title">{{ __('My Studio Activity') }}</x-slot>
    <x-slot name="header">{{ __('My Studio Activity') }}</x-slot>

    <button>{{ __('Export Activity') }} </button>

    <div class="">
        @forelse ($students as $student)
        <livewire:facilitator.student-activity :student="$student" :active="$loop->first" :wire:key="$student->id">
        @empty
        {{ __('No Students') }}
        @endforelse
    </div>
</div>
