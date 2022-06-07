<div x-data="{ openR: @entangle('showManualRegistrationForm').defer, openE: @entangle('showEmail').defer }" class="mt-6 grid grid-cols-1 gap-6 max-w-full">
    <x-slot name="title">{{ __('Lobby') }}</x-slot>
    <x-jet-validation-errors />
    <h1 class="mt-6 text-fuse-teal text-3xl font-bold font-display text-left">{{ __('Welcome to FUSE!') }}</h1>
    <div>
        <label class="text-lg" for="studio_code">{{ __('Studio Code') }}</label>
        <input type="text" name="studio_code" id="studio_code" placeholder="{{ __('e.g. White Wolf 123') }}" wire:model="studioCode" wire:keyup.debounce.600ms="codecheck" />
        @error('studioCode')
        <span class="text-red-500">
            {{ $message }}
        </span>
        @enderror
    </div>
    <div x-show="openE">
        <p> {{ $studioName }} in {{ $school }} </p>
        <form method="POST" action="{{ route('register') }}">
            @csrf
            <div>
                <x-jet-label for="name" value="{{ __('Name') }}" />
                <x-jet-input id="name" class="block mt-1 w-full" type="text" name="name" :value="old('name')" required autofocus autocomplete="name" />
            </div>

            <div>
                <x-jet-label for="email" value="{{ __('Email') }}" />
                <x-jet-input id="email" class="block mt-1 w-full" type="text" name="email" required :value="old('email')" />
            </div>

            <div class="mt-4">
                <x-jet-label for="password" value="{{ __('Password') }}" />
                <x-jet-input id="password" class="block mt-1 w-full" type="password" name="password" required autocomplete="new-password" />
            </div>

            <div class="mt-4">
                <x-jet-label for="password_confirmation" value="{{ __('Confirm Password') }}" />
                <x-jet-input id="password_confirmation" class="block mt-1 w-full" type="password" name="password_confirmation" required autocomplete="new-password" />
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
                <x-jet-input id="name" class="block mt-1 w-full" type="text" name="name" :value="old('name')" required autofocus autocomplete="name" />
            </div>

            <div class="hidden">
                <x-jet-label for="email" value="{{ __('Email') }}" />
                <x-jet-input id="email" class="block mt-1 w-full" type="text" name="email" :value="old('email')" />
            </div>

            <div class="mt-4">
                <x-jet-label for="password" value="{{ __('Password') }}" />
                <x-jet-input id="password" class="block mt-1 w-full" type="password" name="password" required autocomplete="new-password" />
            </div>

            <div class="mt-4">
                <x-jet-label for="password_confirmation" value="{{ __('Confirm Password') }}" />
                <x-jet-input id="password_confirmation" class="block mt-1 w-full" type="password" name="password_confirmation" required autocomplete="new-password" />
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
    <p class="rounded py-2 text-fuse-dk-teal text-base md:text-sm text-center">
    <a class="ml-6 underline" href="https://www.fusestudio.net/">{{ __('Why Fuse?') }}</a>
    <a class="ml-6 underline" href="https://www.fusestudio.net/">{{ __('Free Trial') }}</a>
    <a class="ml-6 underline" href="https://www.fusestudio.net/">{{ __('For Teachers') }}</a>
    </p>
</div>