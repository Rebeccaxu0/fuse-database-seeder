<div>
    <x-slot name="title">{{ __('My Studio Activity') }}</x-slot>
    <x-slot name="header">{{ __('My Studio Activity') }}</x-slot>

    <button>{{ __('Export Activity') }} </button>

    <div class="mt-8 lg:grid lg:grid-cols-3 gap-4">
        <div class="col-start-1 lg:scroll-box">
        @forelse ($students as $student)
            <div wire:click="$emit('activateStudent', {{ $student->id }})" class="@if ($student->id == $activeStudent->id) font-bold bg-fuse-green-50 @else cursor-pointer hover:bg-slate-50 @endif border border-slate-400 rounded-xl px-4 py-1 mb-1">
                <span>O</span>
                <span title="{{ $student->full_name . ' (' . $student->name . ')' }}">
                    {{ Str::limit($student->full_name, 15) }} ({{ Str::limit($student->name, 15) }})
                </span>
                @if ($student->id == $activeStudent->id)<span class="float-right">&gt;</span>@endif
            </div>
            <div class="lg:hidden">
              @if ($student->id == $activeStudent->id)
                  @forelse ($challenges as $challenge)
                      <div wire:click="$emit('activateChallenge', {{ $challenge->id }})" class="@if ($challenge->id == $activeChallenge->id) font-bold bg-fuse-green-50 @else cursor-pointer hover:bg-slate-50 @endif border border-slate-400 rounded-xl px-4 py-2 ml-3 mb-1 uppercase">
                        {{ $challenge->name }} @if ($challenge->id == $activeChallenge->id)<span class="float-right">&gt;</span>@endif
                        <div class="h-4">
                          <x-progress-bar :user="$student" :interactive="false" :challengeVersion="$challenge" />
                        </div>
                          {{ __('Last activity') }}
                      </div>
                      @if ($challenge->id == $activeChallenge->id)
                          @forelse ($artifacts as $artifact)
                              {{ $artifact->type }} ({{ $artifact->artifactable->id }}) <span class="font-bold">{{ $artifact->artifactable->challengeVersion->name }}</span>
                          @empty
                              <div class="font-bold uppercase text-lg ml-4 py-2">
                                {{ __('No artifacts uploaded yet for this challenge') }}
                              </div>
                          @endforelse
                      @endif
                  @empty
                      <div class="font-bold uppercase text-lg ml-4 py-2">
                        {{ __('No saves or completes yet') }}
                      </div>
                  @endforelse
              @endif
            </div>
        @empty
        {{ __('You have not yet added any students to this studio.') }}
        @endforelse
        </div>
        <div class="hidden lg:block col-start-2 scroll-box">
            @forelse ($challenges as $challenge)
            <div wire:click="$emit('activateChallenge', {{ $challenge->id }})" class="@if ($challenge->id == $activeChallenge->id) font-bold bg-fuse-green-50 @else cursor-pointer hover:bg-slate-50 @endif border border-slate-400 rounded-xl px-4 py-2 ml-3 mb-1 uppercase">
              {{ $challenge->name }} @if ($challenge->id == $activeChallenge->id)<span class="float-right">&gt;</span>@endif
                    <div class="h-4">
                      <x-progress-bar :user="$activeStudent" :interactive="false" :challengeVersion="$challenge" />
                    </div>
                    {{ __('Last activity') }}
                </div>
            @empty
            <div class="font-bold uppercase text-lg text-center border rounded-xl p-4">
              {{ __('This student has not yet started any challenges.') }}
            </div>
            @endforelse
        </div>
        <div class="hidden lg:block col-start-3 scroll-box">
            @if ($activeChallenge)
                @forelse ($artifacts as $artifact)
                {{ $artifact->type }} ({{ $artifact->artifactable->id }}) <span class="font-bold">{{ $artifact->artifactable->challengeVersion->name }}</span>
                @empty
                <div class="font-bold uppercase text-lg ml-4 py-2">
                  {{ __('No artifacts uploaded yet for this challenge') }}
                </div>
                @endforelse
            @endif
        </div>
    </div>
</div>
