<x-app-layout>

  <x-challenge-gallery-menu />

  <div class="px-16 py-8 bg-zinc-100
    grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 xl:grid-cols-4 gap-4
    ">
      @forelse ($challengeVersions as $challengeVersion)
          <livewire:challenge-gallery-tile :challengeVersion="$challengeVersion" />
      @empty
          <p>{{ __('No Challenges. Please ask your facilitator to allow challenges.') }}</p>
      @endforelse
  </div>

</x-app-layout>
