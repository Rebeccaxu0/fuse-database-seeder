<div>
    <x-slot name="title">{{ __('My Studio Activity') }}</x-slot>
    <x-slot name="header">{{ __('My Studio Activity') }}</x-slot>

    <button>
      {{ __('Export Activity') }}
    </button>
    <form action="{{ route('facilitator.export_activity', $studio) }}" method="GET">
        <p>
        </p>
        @if ($errors->any())
            <ul>
              @foreach ($errors->all() as $error)
              <li>{{ $error }}</li>
              @endforeach
            </ul>
        @endif
        <fieldset class="sm:flex max-w-md items-center justify-center border border-black p-2">
          <legend class="bg-fuse-teal-dk text-white px-2 py-1">
            {{ __('Download all studio activity between the following dates:') }}
          </legend>
          <div class="float-left sm:flex-1 m-2">
            <label class="font-bold" for='from_date'>{{ __('From') }}</label>
            <input class="w-40" type="date" name="from_date" min="2010-01-01" max="{{ date('Y-m-d') }}" value="{{ old('from_date', date('Y-m-d')) }}">
          </div>
          <div class="float-left sm:flex-1 m-2">
            <label class="font-bold" for='to_date'>{{ __('To') }}</label>
            <input class="w-40" type="date" name="to_date" min="2010-01-01" max="{{ date('Y-m-d') }}" value="{{ old('to_date', date('Y-m-d')) }}">
          </div>
          <div class="float-right sm:flex-1">
            <button class="btn flex-1">{{ __('Submit') }}</button>
          </div>
        </fieldset>
    </form>

    <div class="mt-8 lg:grid lg:grid-cols-3 gap-4">
        <div class="col-start-1 lg:scroll-box">
        @forelse ($students as $student)
            <button wire:click="$emit('activateStudent', {{ $student->id }})" class="@if ($student->id == $activeStudent->id) font-bold bg-fuse-green-50 cursor-default @else hover:bg-slate-50 @endif w-full block text-left border border-slate-400 rounded-xl px-4 py-1 mb-1">
              <div class="inline-block -mb-0.5 border-2 border-slate-300 {{ $student->isOnline() ? 'bg-fuse-green-500': '' }} rounded-lg w-4 h-4">
                    <span class="sr-only">Status: {{ $student->isOnline() ? __('Online') :  __('Offline') }}"</span>
                </div>
                <span title="{{ $student->full_name . ' (' . $student->name . ')' }}">
                  {{ str($student->full_name)->limit(15) }} ({{ str($student->name)->limit(15) }})
                </span>
                @if ($student->id == $activeStudent->id)<span class="float-right">&gt;</span>@endif
            </button>
            <div class="lg:hidden @if ($student->id == $activeStudent->id) scroll-box @endif">
              @if ($student->id == $activeStudent->id)
                  @forelse ($challenges as $challenge)
                      @if ($challenge->id == $activeChallenge->id)
                          <div class="font-bold bg-fuse-green-50 cursor-default block w-full text-left border border-slate-400 rounded-xl px-4 py-2 ml-3 mb-1 uppercase">
                      @else
                          <button wire:click="$emit('activateChallenge', {{ $challenge->id }})"
                            class="hover:bg-slate-50 block w-full text-left border border-slate-400 rounded-xl px-4 py-2 ml-3 mb-1 uppercase">
                        @endif
                        {{ $challenge->name }} @if ($challenge->id == $activeChallenge->id)<span class="float-right">&gt;</span>@endif
                        <x-progress-bar :user="$student" :interactive="false" :challengeVersion="$challenge" class="h-4" />
                        {{ __('Last activity') }} ( {{ $student->lastActivity($challenge) }})
                      @if ($challenge->id == $activeChallenge->id)
                          </div>
                      @else
                          </button>
                      @endif
                      @if ($challenge->id == $activeChallenge->id)
                          @forelse ($artifacts as $artifact)
                            <livewire:artifact-modal-tile :artifact="$artifact" :wire:key="$artifact->id">
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
                @if ($challenge->id == $activeChallenge->id)
                <div class="font-bold bg-fuse-green-50 cursor-default block w-full text-left border border-slate-400 rounded-xl px-4 py-2 mb-1 uppercase">
                @else
                <button wire:click="$emit('activateChallenge', {{ $challenge->id }})"
                  class="hover:bg-slate-50 block w-full text-left border border-slate-400 rounded-xl px-4 py-2 mb-1 uppercase">
                @endif
              {{ $challenge->name }} @if ($challenge->id == $activeChallenge->id)<span class="float-right">&gt;</span>@endif
                    <x-progress-bar :user="$activeStudent" :interactive="false" :challengeVersion="$challenge" class="h-4" />
                    {{ __('Last activity') }}
                @if ($challenge->id == $activeChallenge->id)
                    </div>
                @else
                    </button>
                @endif
            @empty
            <div class="font-bold uppercase text-lg text-center border rounded-xl p-4">
              {{ __('This student has not yet started any challenges.') }}
            </div>
            @endforelse
        </div>
        <div class="hidden lg:block col-start-3 scroll-box">
            @if ($activeChallenge)
                @forelse ($artifacts as $artifact)
                    <livewire:artifact-modal-tile :artifact="$artifact" :wire:key="$artifact->id">
                @empty
                <div class="font-bold uppercase text-lg ml-4 py-2">
                  {{ __('No artifacts uploaded yet for this challenge') }}
                </div>
                @endforelse
            @endif
        </div>
    </div>
</div>
