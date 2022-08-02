<div>
    <x-slot name="title">{{ __('My Studio Activity') }}</x-slot>
    <x-slot name="header">{{ __('My Studio Activity') }}</x-slot>

    <form action="{{ route('facilitator.export_activity', $studio) }}" method="GET">
        @if ($errors->any())
            <ul>
              @foreach ($errors->all() as $error)
              <li>{{ $error }}</li>
              @endforeach
            </ul>
        @endif

        <fieldset class="sm:flex max-w-xl items-center justify-center border border-black p-2">
          <div class="float-left sm:flex-1 m-2">
            <label class="font-bold" for='from_date'>{{ __('From') }}</label>
            <input wire:model="startDate" class="w-40" type="date" min="2010-01-01" max="{{ date('Y-m-d') }}" >
          </div>
          <div class="float-left sm:flex-1 m-2">
            <label class="font-bold" for='to_date'>{{ __('To') }}</label>
            <input wire:model="endDate" class="w-40" type="date" min="2010-01-01" max="{{ date('Y-m-d') }}">
          </div>
          {{-- <div class="float-right sm:flex-1">
            <button class="btn flex-1 bg-grey-200" disabled>{{ __('Download Activity CSV') }}</button>
          </div> --}}
        </fieldset>
    </form>

    <div class="bg-gray-100 p-2 mt-8 lg:grid lg:grid-cols-3 gap-4">

        <div class="col-start-1 lg:scroll-box">

        @forelse ($students as $student)
        <button wire:click="$emit('activateStudent', {{ $student->id }})" class="@if ($student->id == $activeStudent->id) font-bold bg-fuse-green-50 cursor-default @else bg-white hover:bg-slate-50 @endif w-full block text-left border border-slate-400 rounded-xl px-4 py-1 mb-1">
            <div class="inline-block -mb-0.5 border-2 border-slate-300 {{ $student->isOnline() ? 'bg-fuse-green-500': '' }} rounded-lg w-4 h-4">
                <span class="sr-only">Status: {{ $student->isOnline() ? __('Online') :  __('Offline') }}"</span>
            </div>
            <span title="{{ $student->full_name . ' (' . $student->name . ')' }}">
                {{ str($student->full_name)->limit(15) }} ({{ str($student->name)->limit(15) }})
            </span>
            @if ($student->id == $activeStudent->id)<span class="float-right">&gt;</span>@endif
        </button>
        <div class="pl-3 lg:hidden @if ($student->id == $activeStudent->id) scroll-box @endif">
            @if ($student->id == $activeStudent->id)
            @if (! $challenges->count() && ! $ideas->count())
            <div class="bg-white font-bold uppercase text-lg text-center border rounded-xl p-4">
              {{ __('This student has not yet started any challenges or ideas.') }}
            </div>
            @else
                @foreach ($challenges as $challenge)
                @if ($challenge->id == $activeChallenge->id)
                <div class="font-bold bg-fuse-green-50 cursor-default block w-full text-left border border-slate-400 rounded-xl px-4 py-2 mb-1 uppercase">
                @else
                <button wire:click="$emit('activateChallenge', 'challenge', {{ $challenge->id }})"
                            class="bg-white hover:bg-slate-50 block w-full text-left border border-slate-400 rounded-xl px-4 py-2 mb-1 uppercase"/>
                @endif
                        {{ $challenge->name }} @if ($challenge->id == $activeChallenge->id)<span class="float-right">&gt;</span>@endif
                        <x-progress-bar :user="$activeStudent" :interactive="false" :levelable="$challenge" class="h-4" />
                        {{ __('Last activity') }} ({{ $activeStudent->lastActivityOnChallengeVersionOrIdea($challenge) }})
                      @if ($challenge->id == $activeChallenge->id)
                          </div>
                      @else
                          </button>
                      @endif
                      @if ($challenge->id == $activeChallenge->id)
                          @forelse ($artifacts as $artifact)
                            <livewire:artifact-modal-tile :artifact="$artifact" :studio="$studio" :wire:key="$artifact->id">
                          @empty
                              <div class="font-bold uppercase text-lg ml-4 py-2">
                                {{ __('No artifacts in this time period') }}
                              </div>
                          @endforelse
                      @endif
                    @endforeach
                    @foreach ($ideas as $idea)
                        @if ($idea->id == $activeChallenge->id)
                            <div class="font-bold bg-fuse-green-50 cursor-default block w-full text-left border border-slate-400 rounded-xl px-4 py-2 mb-1 uppercase">
                        @else
                            <button wire:click="$emit('activateChallenge', 'idea', {{ $idea->id }})"
                            class="bg-white hover:bg-slate-50 block w-full text-left border border-slate-400 rounded-xl px-4 py-2 mb-1 uppercase">
                        @endif
                        {{ $idea->name }} @if ($idea->id == $activeChallenge->id)<span class="float-right">&gt;</span>@endif
                        <x-progress-bar :user="$activeStudent" :interactive="false" :levelable="$idea" class="h-4" />
                        {{ __('Last activity') }} ({{ $activeStudent->lastActivityOnChallengeVersionOrIdea($idea) }})
                      @if ($idea->id == $activeChallenge->id)
                          </div>
                      @else
                          </button>
                      @endif
                      @if ($idea->id == $activeChallenge->id)
                          @forelse ($artifacts as $artifact)
                            <livewire:artifact-modal-tile :artifact="$artifact" :studio="$studio" :wire:key="$artifact->id">
                          @empty
                              <div class="font-bold uppercase text-lg ml-4 py-2">
                                {{ __('No artifacts in this time period') }}
                              </div>
                          @endforelse
                      @endif
                  @endforeach
                @endif
              @endif
            </div>
        @empty
        {{ __('You have not yet added any students to this studio.') }}
        @endforelse
        </div>

        @if ($students->count() > 0)
        <div class="hidden lg:block col-start-2 scroll-box">
            @if (! $challenges->count() && ! $ideas->count())
            <div class="bg-white font-bold uppercase text-lg text-center border rounded-xl p-4">
              {{ __('This student has not yet started any challenges or ideas.') }}
            </div>
            @else
                @foreach ($challenges as $challenge)
                    @if ($challenge->id == $activeChallenge->id)
                    <div class="font-bold bg-fuse-green-50 cursor-default block w-full text-left border border-slate-400 rounded-xl px-4 py-2 mb-1 uppercase">
                    @else
                    <button wire:click="$emit('activateChallenge', 'challenge', {{ $challenge->id }})"
                    class="bg-white hover:bg-slate-50 block w-full text-left border border-slate-400 rounded-xl px-4 py-2 mb-1 uppercase">
                    @endif
                {{ $challenge->name }} @if ($challenge->id == $activeChallenge->id)<span class="float-right">&gt;</span>@endif
                        <x-progress-bar :user="$activeStudent" :interactive="false" :levelable="$challenge" class="h-4" />
                        {{ __('Last activity') }} ({{ $activeStudent->lastActivityOnChallengeVersionOrIdea($challenge) }})
                    @if ($challenge->id == $activeChallenge->id)
                        </div>
                    @else
                        </button>
                    @endif
                @endforeach
                @foreach ($ideas as $idea)
                    @if ($idea->id == $activeChallenge->id)
                    <div class="font-bold bg-fuse-green-50 cursor-default block w-full text-left border border-slate-400 rounded-xl px-4 py-2 mb-1 uppercase">
                    @else
                    <button wire:click="$emit('activateChallenge', 'idea', {{ $idea->id }})"
                    class="bg-white hover:bg-slate-50 block w-full text-left border border-slate-400 rounded-xl px-4 py-2 mb-1 uppercase">
                    @endif
                {{ $idea->name }} @if ($idea->id == $activeChallenge->id)<span class="float-right">&gt;</span>@endif
                        <x-progress-bar :user="$activeStudent" :interactive="false" :levelable="$idea" class="h-4" />
                        {{ __('Last activity') }} ({{ $activeStudent->lastActivityOnChallengeVersionOrIdea($idea) }})
                    @if ($idea->id == $activeChallenge->id)
                        </div>
                    @else
                        </button>
                    @endif
                @endforeach
            @endif
        </div>
        <div class="hidden lg:block col-start-3 scroll-box">
            @if ($activeChallenge)
                @forelse ($artifacts as $artifact)
                    <livewire:artifact-modal-tile :artifact="$artifact" :studio="$studio" :wire:key="$artifact->id">
                @empty
                <div class="font-bold uppercase text-lg ml-4 py-2">
                  {{ __('No artifacts in this time period') }}
                </div>
                @endforelse
            @endif
        </div>
        @endif
    </div>
</div>
