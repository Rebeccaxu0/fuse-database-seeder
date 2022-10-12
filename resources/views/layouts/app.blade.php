@push('scripts')
  {{-- Naive implementation to keep 'online' in sync by pinging
        server once every five minutes. Ways to improve:
        + heartbeat endpoint on separate server
        + put fetch on background thread (web/service worker) --}}
    <script>
        // setInterval(() => fetch('/heartbeat'), 300000);
    </script>
@endpush

<x-base-layout>
    <x-slot name="title">{!! $title ?? null !!}</x-slot>

    <div id='env' {{ $attributes(['class' => 'container flex flex-col p-0 min-h-screen']) }} >
        <x-jet-banner />
        <livewire:announcement-banner :user="auth()->user()" />
        @impersonating
        <div class="relative">
        <a href="{{ route('impersonate.leave') }}">Stop Masquerading as `{{ Auth::user()->name}}`</a>
        </div>
        @endImpersonating

        <header class="mt-2">
            <x-studio-switcher />

            @if (isset($header))
            <h1 class="float-left flex items-center text-fuse-teal-dk text-4xl font-black font-display max-w-7xl m-0 py-0 px-4 sm:px-6 lg:px-8">
                {{ $header }}
            </h1>
            @endif
        </header>

        <main class="flex-grow relative pt-4 pb-10 px-8">

            {{ $slot }}

            <div class="absolute bottom-0 left-0 right-0 px-8">
              <livewire:impersonate />
            </div>
        </main>

    </div>

    <x-footer />

</x-base-layout>
