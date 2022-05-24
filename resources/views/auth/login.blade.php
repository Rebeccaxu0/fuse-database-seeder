<x-guest-logo-layout>
    <x-slot name="title">{{ __('Sign In') }}</x-slot>

    <h1 class="mt-6 text-fuse-teal text-3xl font-bold font-display text-left">{{ __('Sign In') }}</h1>

    <div class="mt-6 grid grid-cols-1 gap-6 max-w-full">
        <x-jet-validation-errors />
        <form method="POST" action="{{ route('login') }}">
            @csrf
            <x-jet-label for="name" value="{{ __('Username') }}" class="text-base" />
            <x-jet-input id="name" type="text" name="name" :value="old('name')" class="border-none"
                required autofocus autocomplete="username" />
            <x-jet-label for="password" value="{{ __('Password') }}" class="text-base mt-1" />
            <x-jet-input id="password" type="password" name="password" class="border-none" required
                autocomplete="current-password" />
            <div class="mt-8">
                <x-jet-button class="bg-fuse-green text-black w-full lg:max-w-xs">
                    {{ __('Sign in') }}
                </x-jet-button>
            </div>
        </form>

        @if (JoelButcher\Socialstream\Socialstream::show())
            <x-socialstream-providers />
        @endif

        <p class="bg-white rounded py-2 text-fuse-dk-teal text-base md:text-sm text-center">
            <a class="underline" href="{{ route('registerlobby') }}">Sign up</a> | <a href="{{ route('password.request') }}" class="underline">Forgot username or password</a>
        </p>
    </div>
</x-guest-logo-layout>
