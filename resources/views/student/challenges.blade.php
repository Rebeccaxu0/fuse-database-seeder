@pushOnce('scripts')
    <script src="https://fast.wistia.net/assets/external/E-v1.js" async></script>
@endPushOnce

<x-app-layout>

    <x-slot name="title">{{ __('My Challenges') }}</x-slot>

    <x-slot name="header">
        <span class="relative mr-2">
            <x-avatar :user="auth()->user()" class="h-16 w-16"/>
        </span>
        {{ __('My Challenges') }}
    </x-slot>

  <x-challenge-gallery-menu />

  <div class="px-8 py-8 bg-neutral-100 grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 xl:grid-cols-4 gap-4">
      @forelse ($challengeVersions as $challengeVersion)
          <livewire:challenge-gallery-tile :challengeVersion="$challengeVersion" :user="auth()->user()" />
      @empty
          <p>{{ __('No Challenges. Please ask your facilitator to allow challenges.') }}</p>
      @endforelse
  </div>

</x-app-layout>
