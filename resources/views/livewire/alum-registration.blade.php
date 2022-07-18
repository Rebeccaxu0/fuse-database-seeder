<div class="bg-fuse-teal-500 lg:p-24">
    <x-jet-banner />
    <div class="p-12 bg-transparent rounded-xl shadow-xl border md:container md:p-24">
        <div class="md:flex md:flex-row bg-white rounded-xl shadow-xl p-8 md:p-8 px-1 mx-auto md:container">
            <div class="hidden invisible md:visible md:block mx-auto">
                <img class="object-contain h-96" src="{{ asset('/img/interest.svg') }}">
            </div>

            <div x-data="{ openJ: @entangle('showJoin').defer, openE: @entangle('showEmail').defer }" class="mt-6 grid grid-cols-1 gap-6 max-w-full">
                <x-slot name="title">{{ __('Lobby') }}</x-slot>
                <div class="p-12 md:pt-8 pb-8 mx-auto">
                    <div>
                        <span><img class="h-16 rounded-full" src="{{ auth()->user()->getPhotoUrl() }}"></span>
                        <span class="text-xl">{{ auth()->user()->name }}</span>
                    </div>
                    <h1>{{ __('Welcome Back!') }}</h1>
                    <div>
                        <form wire:submit.prevent="codecheck" onkeydown="return event.key != 'Enter';">
                            <h3>{{ __('Please enter your Studio Code') }}</h3>
                            <input type="text" class="border-2 border-gray-200 shadow-md rounded block h-10 text-slate-500 w-64 p-2 m-4" name="studio_code" id="studio_code" placeholder="{{ __('TINY WIRE 178') }}" wire:model="studioCode" wire:keyup.debounce.600ms="codecheck" />
                            @error('studioCode')
                            <span class="text-red-500">
                                {{ $message }}
                            </span>
                            @enderror
                            <div x-show="openE">
                                <x-jet-label for="email" value="{{ __('Email') }}" />
                                <x-jet-input id="email" class="block mt-1 rounded text-slate-500 w-full" type="text" name="email" :value="old('email')" />
                            </div>
                            <p class="mt-6" x-show="openJ">{{ __(':studio in :school', ['studio' => $studioName, 'school' => $school]) }}</p>
                            <button type="submit" x-show="openJ" wire:click="join">{{ __('Join') }}</button>
                        </form>
                    </div>
                    <div x-show="! openJ">
                        <h3>{{ __('No Studio Code?') }}</h3>
                        <ul>
                            <li>{!! __('You can still access your <a href=":mystuff">My Stuff</a>', ['mystuff' => route('student.my_stuff')]) !!}</li>
                            <li>{!! __('Try our <a href="https://www.fusestudio.net/try">Free Trial</a> version of FUSE') !!}</li>
                        </ul>
                    </div>
                </div>
            </div>
        </div>

        <div class="flex flex-row p-8 gap-8">
            <div class="grow mx-auto text-center">
                <img class="h-24 mx-auto mb-4" src="{{ asset('/img/youtube.svg') }}">
                <span class="font-bold mx-auto"><a href="https://www.fusestudio.net/try">{{ __('Free Trial') }}</a></span>
            </div>
            <div class="grow mx-auto text-center">
                <img class="h-24 mx-auto mb-4" src="{{ asset('/img/smile.svg') }}">
                <span class="font-bold mx-auto"><a href="https://www.fusestudio.net/">{{ __('Why FUSE?') }}</a></span>
            </div>
            <div class="grow mx-auto text-center">
                <img class="fill-white h-24 mx-auto mb-4" src="{{ asset('/img/users.svg') }}">
                <span class="text-fuse-teal-700 font-bold mx-auto"> <a href="https://www.fusestudio.net/get-started">{{ __('For Teachers') }}</a></span>
            </div>
        </div>
    </div>
</div>
