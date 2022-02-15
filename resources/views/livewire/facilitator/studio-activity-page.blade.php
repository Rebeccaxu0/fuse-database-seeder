<div>
    <x-slot name="title">{{ __('My Studio Activity') }}</x-slot>
    <x-slot name="header">{{ __('My Studio Activity') }}</x-slot>

    <button>{{ __('Export Activity') }} </button>

    <div class="">
        @forelse ($students as $student_key => $student)
        <div wire:click="$emit('activateStudent', {{ $student_key }})" class="@if ($student_key == $activeStudent) font-bold bg-fuse-green-50 @else cursor-pointer hover:bg-slate-50 @endif border border-slate-400 rounded-xl px-4 py-1 mb-1">
              <span>Online-status</span>
              {{ $student->full_name }} ({{ $student->name }} - {{ $student->id }}) @if ($student_key == $activeStudent)<span class="float-right">&gt;</span>@endif
            </div>
            @if ($student_key == $activeStudent)
                @foreach ($challenges as $challenge_key => $challenge)
                {{-- @if ($student->startedChallenge($challenge))) --}}
                <div wire:click="$emit('activateChallenge', {{ $challenge_key }})" class="@if ($challenge_key == $activeChallenge) font-bold bg-fuse-green-50 @else cursor-pointer hover:bg-slate-50 @endif border border-slate-400 rounded-xl px-4 py-2 ml-3 mb-1 uppercase">
                        {{ $challenge->name }} @if ($challenge_key == $activeChallenge)<span class="float-right">&gt;</span>@endif
                        <x-progress-bar :user="$student" :interactive="false" :challengeVersion="$challenge" />
                        {{ __('Last activity') }}
                    </div>
                    @if ($challenge_key == $activeChallenge)
                        @forelse ($artifacts as $artifact)
                        {{ $artifact->type }} ({{ $artifact->artifactable->id }}) <span class="font-bold">{{ $artifact->artifactable->challengeVersion->name }}</span>
                        @empty
                        <div class="font-bold uppercase text-lg ml-4 py-2">
                          {{ __('No artifacts uploaded yet for this challenge') }}
                        </div>
                        @endforelse
                    @endif
                {{-- @endif --}}
                @endforeach
            @endif
        @empty
        {{ __('No Students') }}
        @endforelse
    </div>
</div>
