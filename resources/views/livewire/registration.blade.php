<div class="bg-fuse-teal-500 lg:p-24">
    <div class="p-12 bg-transparent rounded-xl shadow-xl border md:container md:p-24">
        <div class="md:flex md:flex-row bg-white rounded-xl shadow-xl p-8 md:p-8 px-1 mx-auto md:container">
            <div class="hidden invisible md:visible md:block mx-auto">
                <img class="object-contain h-96" src="{{ asset('/img/interest.svg') }}">
            </div>
            <div x-data="{ openR: @entangle('showManualRegistrationForm').defer, openE: @entangle('showEmailForm').defer }" class="grid grid-cols-1 max-w-full">
                <x-slot name="title">{{ __('Lobby') }}</x-slot>
                <div class="p-12 md:pt-8 pb-8 mx-auto">
                    <h1>{{ __('Welcome to FUSE') }}</h1>
                    <div>
                        <h3>{{ __('Please enter your Studio Code') }}</h3>
                        <input type="text" class="border-2 border-gray-200 shadow-md rounded block h-10 w-1/3 text-slate-500 w-64 p-2 m-4" name="studio_code" id="studio_code" placeholder="{{ __('TINY WIRE 178') }}" wire:model="studioCode" wire:keyup.debounce.600ms="codecheck" />
                        @error('studioCode')
                        <span class="text-red-500">
                            {{ $message }}
                        </span>
                        @enderror
                    </div>
                    <div x-show="openE">
                        <p> {{ $studioName }} in {{ $school }} </p>
                        <form method="POST" class="text-gray-700" action="{{ route('register') }}">
                            @csrf
                            <div>
                                <x-jet-label for="name" value="{{ __('Name') }}" />
                                <x-jet-input id="name" class="block mt-1 text-slate-500 w-full rounded " type="text" name="name" :value="old('name')" required autofocus autocomplete="name" />
                            </div>

                            <div>
                                <x-jet-label for="email" value="{{ __('Email') }}" />
                                <x-jet-input id="email" class="block mt-1 text-slate-500 w-full rounded " type="text" name="email" required :value="old('email')" />
                            </div>

                            <div class="mt-4">
                                <x-jet-label for="password" value="{{ __('Password') }}" />
                                <x-jet-input id="password" class="block mt-1 w-full rounded " type="password" name="password" required autocomplete="new-password" />
                            </div>

                            <div class="mt-4">
                                <x-jet-label for="password_confirmation" value="{{ __('Confirm Password') }}" />
                                <x-jet-input id="password_confirmation" class="block mt-1 w-full rounded " type="password" name="password_confirmation" required autocomplete="new-password" />
                            </div>

                            <div class="hidden">
                                <x-jet-input id="studio" class="block mt-1 w-full" name="studio" :value="$studioCode" />
                            </div>

                            @if (Laravel\Jetstream\Jetstream::hasTermsAndPrivacyPolicyFeature())
                            <div class="mt-4">
                                <x-jet-label for="terms">
                                    <div class="flex items-center">
                                        <x-jet-checkbox name="terms" id="terms" />

                                        <div class="ml-2">
                                            {!! __('I agree to the :terms_of_service and :privacy_policy', [
                                            'terms_of_service' => '<a target="_blank" href="' . route('terms.show') . '" class="underline text-sm text-gray-600 hover:text-gray-900">' . __('Terms of Service') . '</a>',
                                            'privacy_policy' => '<a target="_blank" href="' . route('policy.show') . '" class="underline text-sm text-gray-600 hover:text-gray-900">' . __('Privacy Policy') . '</a>',
                                            ]) !!}
                                        </div>
                                    </div>
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
                    <div x-show="openR">
                        <p> {{ $studioName }} in {{ $school }} </p>
                        <form method="POST" action="{{ route('register') }}">
                            @csrf
                            <div>
                                <x-jet-label for="name" value="{{ __('Name') }}" />
                                <x-jet-input id="name" class="block mt-1 w-full text-slate-500 rounded " type="text" name="name" :value="old('name')" required autofocus autocomplete="name" />
                            </div>

                            <div class="hidden">
                                <x-jet-label for="email" value="{{ __('Email') }}" />
                                <x-jet-input id="email" class="block mt-1 w-full text-slate-500 rounded " type="text" name="email" :value="old('email')" />
                            </div>

                            <div class="mt-4">
                                <x-jet-label for="password" value="{{ __('Password') }}" />
                                <x-jet-input id="password" class="block mt-1 w-full rounded" type="password" name="password" required autocomplete="new-password" />
                            </div>

                            <div class="mt-4">
                                <x-jet-label for="password_confirmation" value="{{ __('Confirm Password') }}" />
                                <x-jet-input id="password_confirmation" class="block mt-1 w-full  rounded" type="password" name="password_confirmation" required autocomplete="new-password" />
                            </div>

                            <div class="hidden">
                                <x-jet-input id="studio" class="block mt-1 w-full" name="studio" :value="$studioCode" />
                            </div>

                            @if (Laravel\Jetstream\Jetstream::hasTermsAndPrivacyPolicyFeature())
                            <div class="mt-4">
                                <x-jet-label for="terms">
                                    <div class="flex items-center">
                                        <x-jet-checkbox name="terms" id="terms" />

                                        <div class="ml-2">
                                            {!! __('I agree to the :terms_of_service and :privacy_policy', [
                                            'terms_of_service' => '<a target="_blank" href="' . route('terms.show') . '" class="underline text-sm text-gray-600 hover:text-gray-900">' . __('Terms of Service') . '</a>',
                                            'privacy_policy' => '<a target="_blank" href="' . route('policy.show') . '" class="underline text-sm text-gray-600 hover:text-gray-900">' . __('Privacy Policy') . '</a>',
                                            ]) !!}
                                        </div>
                                    </div>
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
                    <div x-show="! openR">
                        <h3>{{ __('No Studio Code?') }}</h3>
                        <ul>
                            <li>Ask your teacher for a Studio Code </li>
                            <li>Try our <a href="https://www.fusestudio.net/try">Free Trial</a> version of FUSE</li>
                        </ul>
                    </div>
                </div>
            </div>
        </div>

        <div class="flex flex-row p-8 gap-8">
            <div class="grow mx-auto text-center">
                <img class="h-24 mx-auto mb-4" src="{{ asset('/img/youtube.svg') }}">
                <span class="font-bold mx-auto"><a href="https://www.fusestudio.net/try">Free Trial</a></span>
            </div>
            <div class="grow mx-auto text-center">
                <img class="h-24 mx-auto mb-4" src="{{ asset('/img/smile.svg') }}">
                <span class="font-bold mx-auto"><a href="https://www.fusestudio.net/">Why FUSE?</a></span>
            </div>
            <div class="grow mx-auto text-center">
                <img class="fill-white h-24 mx-auto mb-4" src="{{ asset('/img/users.svg') }}">
                <span class="text-fuse-teal-700 font-bold mx-auto"> <a href="https://www.fusestudio.net/get-started">For Teachers</a></span>
            </div>

        </div>
    </div>
</div>
</div>
</div>
</div>