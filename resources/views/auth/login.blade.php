<x-guest-logo-layout>
    <x-slot name="title">{{ __('Sign In') }}</x-slot>

    <h1 class="mt-6 text-fuse-teal text-3xl font-bold font-display text-left">{{ __('Sign In') }}</h1>

    <div x-data="{ submitted: false }"
    class="mt-6 grid grid-cols-1 gap-6 max-w-full">
        <x-jet-validation-errors />
        <form x-ref="form" method="POST" action="{{ route('login') }}">
            @csrf
            <x-jet-label for="name" value="{{ __('Username') }}" class="text-base" />
            <input
                id="name"
                type="text"
                name="name"
                class="border-none"
                value="{{ old('name') }}"
                required
                autofocus
                autocomplete="name" />
            <x-jet-label for="password" value="{{ __('Password') }}" class="text-base mt-1" />
            <x-jet-input x-ref="password" id="password" type="password" name="password" class="border-none" required
                autocomplete="current-password" />
            <div class="mt-8">
                <button type="submit" class="text-black w-full lg:max-w-xs"
                    x-bind:disabled="submitted"
                    x-on:click="if ($refs.form.checkValidity()) {submitted = true; $refs.form.submit();}">
                    {{ __('Sign in') }}
                    <div x-cloak x-show="submitted" class="spinner-grow inline-block w-4 h-4 bg-current rounded-full opacity-0
                    text-green-500" role="status">
                        <span class="visually-hidden">{{ __('Signing you in...') }}</span>
                    </div>
                </button>
            </div>
        </form>

        @if (JoelButcher\Socialstream\Socialstream::show())
            <x-socialstream-providers />
        @endif

        <p class="bg-white rounded py-2 text-fuse-dk-teal text-base md:text-sm text-center">
            <a class="underline" href="{{ route('lobby') }}">Sign up</a> | <a href="{{ route('password.request') }}" class="underline">Forgot username or password</a>
        </p>
    </div>
</x-guest-logo-layout>
