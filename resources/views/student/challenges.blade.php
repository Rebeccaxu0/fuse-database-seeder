<x-app-layout>

    <x-slot name="title">{{ __('Challenges') }}</x-slot>

    <x-slot name="header">{{ __('Challenges') }}</x-slot>

    @forelse ($challengeVersions as $challengeVersion)
        <x-challenge-tile :challengeVersion="$challengeVersion" />
    @empty
        <p>{{ __('No Challenges. Please ask your facilitator to allow challenges.') }}</p>
    @endforelse
</x-app-layout>
