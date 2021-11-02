<x-guest-layout>
    <main class="container flex-shrink flex-grow
                 min-h-screen mx-auto py-16
                 lg:px-4">
      <div class="mx-auto my-auto p-8 w-2/3
               bg-gradient-to-t from-fuse-teal-100 to-white
               rounded-lg shadow-lg border
               sm:px-12 lg:flex lg:w-2/3">
        <div class="lg:flex-1">
          <img class="mx-auto min-h-8 max-h-36
                   md:max-h-48 lg:max-h-72 lg:pr-12 lg:pt-24 xl:pt-16"
            src="/fuse-logo.svg">
        </div>
        <div class="lg:flex-1">
          <h2 class="mt-6 text-fuse-teal text-3xl font-bold font-display text-left">Sign In</h2>
          <div class="mt-6 grid grid-cols-1 gap-6 max-w-full">
            <form method="POST" action="{{ route('login') }}">
              @csrf
              <x-jet-label for="name" value="{{ __('Username') }}" class="text-base" />
              <x-jet-input id="name" type="text" name="name" :value="old('name')"
                           class="border-none" required autofocus />
              <x-jet-label for="password" value="{{ __('Password') }}" class="text-base mt-1" />
              <x-jet-input id="password" type="password" name="password"
                           class="border-none" required autocomplete="current-password" />
              <div class="mt-8">
                <x-jet-button class="btn w-full lg:max-w-xs">
                  {{ __('Sign in') }}
                </x-jet-button>
              </div>
            </form>
            <img src="/btn_google_signin_light_normal_web.png">
            <p class="text-fuse-dk-teal text-base md:text-sm">
              sign up | forgot username or password
            </p>
          </div>
    </main>
</x-guest-layout>