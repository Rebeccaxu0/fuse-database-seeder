<x-guest-layout>
    <main class="container mx-auto flex-shrink flex-grow lg:px-4 py-16">
      <div class="mx-auto my-auto">
        <div class="min-w-screen min-h-screen">
          <div class="lg:flex mx-auto my-auto w-2/3 lg:w-2/3 bg-gradient-to-t from-fuse-teal-100 to-white rounded-lg shadow-lg border p-8 sm:px-12">
            <div class="lg:flex-1">
              <img class="min-h-8 max-h-36 md:max-h-48 lg:max-h-72 lg:pr-12 lg:pt-24 xl:pt-16" src="/fuse-logo.svg">
            </div>
            <div class="lg:flex-1">
              <h2 class="mt-6 text-fuse-teal text-3xl font-bold font-display text-left">Sign In</h2>
              <div class="mt-6 grid grid-cols-1 gap-6 max-w-full">
                <form method="POST" action="{{ route('login') }}">
                  @csrf
                    <x-jet-label for="name" value="{{ __('Username') }}" class="block text-md text-gray-700" />
                      <x-jet-input id="name" class="block mt-1 w-full" type="text" name="name" :value="old('name')" required autofocus />
                    <x-jet-label for="password" value="{{ __('Password') }}" class="block text-md text-gray-700 mt-4"/>
                      <x-jet-input id="password" class="block mt-1 w-full" type="password" name="password" required autocomplete="current-password"/>
                  <div class="mt-8">
                    <x-jet-button class="max-w-xs btn block w-full">
                      {{ __('Sign in') }}
                    </x-jet-button>
                  </div>
                </form>
                <img src="/btn_google_signin_light_normal_web.png">
                <p class="text-fuse-dk-teal md:text-s"> sign up | forgot username or password
              </div>
            </div>
          </div>
    </main>
</x-guest-layout>