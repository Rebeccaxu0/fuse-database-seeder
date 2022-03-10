<x-app-layout>
  <x-challenge-gallery-menu />
  <div class="grid grid-cols-2 sm:grid-cols-3 xl:grid-cols-4 gap-4 px-16 py-8 bg-zinc-100">
    @forelse ($challengeVersions as $challengeVersion)
    <x-challenge-tile :challengeVersion="$challengeVersion" />
      @empty
      <p>{{ __('No Challenges. Please ask your facilitator to allow challenges.') }}</p>
      @endforelse
  </div>
</x-app-layout>
