<x-slot name="title">{{ $title }}</x-slot>

<div class="bg-fuse-teal-500 lg:p-24">
    <div class="md:container bg-transparent rounded-xl shadow-xl border p-12 md:p-24">
        <div class="md:container md:flex md:flex-row bg-white rounded-xl shadow-xl py-8 px-1 mx-auto">

            <div class="invisible md:visible md:block mx-auto">
                <img class="object-contain h-96" src="{{ asset('/img/interest.svg') }}">
            </div>

            <div class="grid grid-cols-1 max-w-full">
                <div class="p-12 md:pt-8 pb-8 mx-auto">

                    @auth
                    <div>
                        <span><img class="h-16 rounded-full" src="{{ auth()->user()->getPhotoUrl() }}"></span>
                        <span class="text-xl">{{ auth()->user()->name }}</span>
                    </div>
                    @endauth

                    <h1>{{ $title }}</h1>
                    <div>
                        <h3>{{ __('Please enter your Studio Code') }}</h3>
                        <input type="text"
                               class="border-2 border-gray-200 shadow-md rounded block h-10 text-slate-500 w-64 p-2 m-4"
                               placeholder="{{ __('TINY WIRE 178') }}"
                               wire:model.debounce.500ms="studioCode"
                               />
                        <div wire:loading.delay wire:target="studioCode">
                            {{ __('Checking Code...') }}
                        </div>
                        @error('studioCode')
                        <span class="text-red-500">
                            {{ $message }}
                        </span>
                        @enderror

                        @if ($validStudioCode)
                        <p class="mt-6">{{ __(':studio in :school', ['studio' => $studioName, 'school' => $school]) }}</p>

                        @auth
                        <form wire:submit.prevent="submit" onkeydown="return event.key != 'Enter';">
                            @if ($studio->require_email)
                            <div>
                                <x-jet-label for="email" value="{{ __('Email') }}" />
                                <input type="email"
                                        class="border-2 border-gray-200 shadow-md rounded block h-10 text-slate-500 w-64 p-2 m-4"
                                        required
                                        name="email"
                                        id="email"
                                        wire:model="email"
                                        />
                                @error('email')
                                <span class="text-red-500">
                                    {{ $message }}
                                </span>
                                @enderror
                            </div>
                            @endif
                            <button type="submit" wire:click="submit">{{ __('Join') }}</button>
                        </form>
                        @endauth

                        @guest
                        <div>
                            <form method="POST" class="text-gray-700" action="{{ route('register') }}">
                                @csrf
                                <input type="hidden" name="studioCode" wire:model="studioCode" />

                                <div>
                                    <x-jet-label for="name" value="{{ __('Username') }}*" />
                                    <x-jet-input type="text"
                                                 id="name"
                                                 name="name"
                                                 :value="old('name')"
                                                 class="block mt-1 text-slate-500 w-full rounded"
                                                 required autofocus autocomplete="name" />
                                    @error('name')
                                    <span class="text-red-500">
                                        {{ $message }}
                                    </span>
                                    @enderror
                                </div>

                                <div>
                                    <x-jet-label for="fullName" value="{{ __('Full Name') }}*" />
                                    <x-jet-input type="text"
                                                    id="fullName"
                                                    placeholder="e.g. Laverne Shirley"
                                                    name="fullName"
                                                    :value="old('fullName')"
                                                    class="block mt-1 text-slate-500 w-full rounded"
                                                    required autofocus autocomplete="fullName" />
                                    @error('fullName')
                                    <span class="text-red-500">
                                        {{ $message }}
                                    </span>
                                    @enderror
                                </div>

                                @if ($studio->require_email)
                                <div>
                                    <x-jet-label for="email" value="{{ __('Email') }}*" />
                                    <x-jet-input type="text"
                                                 id="email"
                                                 name="email"
                                                 :value="old('email')"
                                                 class="block mt-1 text-slate-500 w-full rounded"
                                                 required />
                                    @error('email')
                                    <span class="text-red-500">
                                        {{ $message }}
                                    </span>
                                    @enderror
                                </div>
                                @endif

                                <div class="mt-4">
                                    <x-jet-label for="password" value="{{ __('Password') }}*" />
                                    <x-jet-input type="password"
                                                 id="password"
                                                 name="password"
                                                 class="block mt-1 w-full rounded"
                                                 required autocomplete="new-password" />
                                    @error('password')
                                    <span class="text-red-500">
                                        {{ $message }}
                                    </span>
                                    @enderror
                                </div>

                                <div class="mt-4">
                                    <x-jet-label for="password_confirmation" value="{{ __('Confirm Password') }}*" />
                                    <x-jet-input type="password"
                                                 id="password_confirmation"
                                                 name="password_confirmation"
                                                 class="block mt-1 w-full rounded"
                                                 required autocomplete="new-password" />
                                    @error('password_confirmation')
                                    <span class="text-red-500">
                                        {{ $message }}
                                    </span>
                                    @enderror
                                </div>

                                @if (Laravel\Jetstream\Jetstream::hasTermsAndPrivacyPolicyFeature())
                                <div class="mt-4">
                                    <x-jet-label for="terms">
                                        <div class="flex items-center">
                                            <x-jet-checkbox name="terms" id="terms" />

                                            <div class="ml-2">
                                                {!! __('I agree to the <a target="_blank" href=":tos_link" class="underline text-sm text-gray-600 hover:text-gray-900">Terms of service</a> and <a target="_blank" href=":pp_link" class="underline text-sm text-gray-600 hover:text-gray-900">Privacy Policy</a>.', [
                                                'tos_link' => 'https://www.fusestudio.net/terms',
                                                'pp_link' => 'https://www.fusestudio.net/privacy',
                                                ]) !!}
                                            </div>
                                        </div>
                                        @error('terms')
                                        <span class="text-red-500">
                                            {{ $message }}
                                        </span>
                                        @enderror
                                    </x-jet-label>
                                </div>
                                @endif

                                <div class="mt-8">
                                    <x-jet-button class="btn w-full lg:max-w-xs">
                                        {{ __('Register') }}
                                    </x-jet-button>
                                </div>
                            </form>
                        </div>
                        @endguest
                    @else
                    <div>
                        <h3>{{ __('No Studio Code?') }}</h3>
                        <ul>
                            <li>{{ __('Ask your teacher for a Studio Code') }}</li>
                            <li>{!! __('Try our <a href=":link">Free Trial</a> version of FUSE', ['link' => 'https://www.fusestudio.net/try']) !!}</li>
                        </ul>
                    </div>
                    @endif
                    </div>
                </div>
            </div>
        </div>

        <div class="flex flex-row p-8 gap-8">
            <div class="grow mx-auto text-center">
                <img class="h-24 mx-auto mb-4" src="{{ asset('/img/youtube.svg') }}">
                <span class="font-bold mx-auto">
                    <a href="https://www.fusestudio.net/try">{{ __('Free Trial') }}</a>
                </span>
            </div>
            <div class="grow mx-auto text-center">
                <img class="h-24 mx-auto mb-4" src="{{ asset('/img/smile.svg') }}">
                <span class="font-bold mx-auto">
                    <a href="https://www.fusestudio.net/">{{ __('Why FUSE?') }}'</a>
                </span>
            </div>
            <div class="grow mx-auto text-center">
                <img class="fill-white h-24 mx-auto mb-4" src="{{ asset('/img/users.svg') }}">
                <span class="text-fuse-teal-700 font-bold mx-auto">
                    <a href="https://www.fusestudio.net/get-started">{{ __('For Teachers') }}</a>
                </span>
            </div>

        </div>
    </div>
</div>

