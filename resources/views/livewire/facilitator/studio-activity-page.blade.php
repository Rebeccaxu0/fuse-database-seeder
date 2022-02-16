<div>
    <x-slot name="title">{{ __('My Studio Activity') }}</x-slot>
    <x-slot name="header">{{ __('My Studio Activity') }}</x-slot>

    <button>{{ __('Export Activity') }} </button>

    <div class="">
        @forelse ($students as $student)
        <div wire:click="$emit('activateStudent', {{ $student->id }})" class="@if ($student->id == $activeStudentId) font-bold bg-fuse-green-50 @else cursor-pointer hover:bg-slate-50 @endif border border-slate-400 rounded-xl px-4 py-1 mb-1">
              <span>Online-status</span>
              {{ $student->full_name }} ({{ $student->name }} - {{ $student->id }}) @if ($student->id == $activeStudentId)<span class="float-right">&gt;</span>@endif
            </div>
            @if ($student->id == $activeStudentId)
                @forelse ($challenges as $challenge)
                <div wire:click="$emit('activateChallenge', {{ $challenge->id }})" class="@if ($challenge->id == $activeChallengeId) font-bold bg-fuse-green-50 @else cursor-pointer hover:bg-slate-50 @endif border border-slate-400 rounded-xl px-4 py-2 ml-3 mb-1 uppercase">
                  {{ $challenge->name }} @if ($challenge->id == $activeChallengeId)<span class="float-right">&gt;</span>@endif
                        <x-progress-bar :user="$student" :interactive="false" :challengeVersion="$challenge" />
                        {{ __('Last activity') }}
                    </div>
                    @if ($challenge->id == $activeChallengeId)
                        @forelse ($artifacts as $artifact)
                        {{ $artifact->type }} ({{ $artifact->artifactable->id }}) <span class="font-bold">{{ $artifact->artifactable->challengeVersion->name }}</span>
                        @empty
                        <div class="font-bold uppercase text-lg ml-4 py-2">
                          {{ __('No artifacts uploaded yet for this challenge') }}
                        </div>
                        @endforelse
                    @endif
                @empty
                {{ __('No activity yet') }}
                @endforelse
            @endif
        @empty
        {{ __('No Students') }}
        @endforelse
    </div>
</div>
