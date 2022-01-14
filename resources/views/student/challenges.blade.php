<x-app-layout>
    @forelse ($challengeVersions as $challengeVersion)
        <x-challenge-tile :challengeVersion="$challengeVersion" />
    @empty
        <p>{{ __('No Challenges. Please ask your facilitator to allow challenges.') }}</p>
    @endforelse
</x-app-layout>
