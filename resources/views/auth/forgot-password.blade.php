<x-guest-logo-layout>
    <h2 class="mt-6 text-fuse-teal text-3xl font-bold font-display text-left">{{ __('Password reset') }}</h2>
        <div class="mt-4 mb-4 text-sm text-gray-600">
            {{ __('Forgot your password? No problem. Just let us know your email address and we will email you a password reset link that will allow you to choose a new one.') }}
        </div>

        @if (session('status'))
            <div class="mb-4 font-medium text-sm text-green-600">
                {{ session('status') }}
            </div>
        @endif

        <x-jet-validation-errors class="mb-4" />

        <form method="POST" action="{{ route('password.email') }}">
            @csrf

            <div class="block">
                <x-jet-label for="email" value="{{ __('Email') }}" />
                <x-jet-input id="email" class="block mt-1 w-full" type="email" name="email" :value="old('email')"
                    required autofocus />
            </div>

            <div class="flex items-center justify-end mt-4 gap-3">
              <a class="btn bg-gray-300 rounded-lg text-gray-500 p-2 font-bold" href="/login">{{ __('Cancel') }}</a>
                <x-jet-button>
                    {{ __('Email Password Reset Link') }}
                </x-jet-button>
            </div>
        </form>
</x-guest-logo-layout>
