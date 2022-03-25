<div {{ $attributes->merge() }}>
    <h2 class="text-left">
        {{ __('Also In Progress') }}
    </h2>
    @forelse ($startedChallengeVersions as $challengeVersion)
        <h3 class="text-fuse-teal mb-0">
            {{ $challengeVersion->challenge->name }}
        </h3>
        <x-progress-bar :user="$user" :interactive="true" :challengeVersion="$challengeVersion" class="h-4 my-0" />
    @empty
        {{ __('Nothing started! Choose a challenge.') }}
    @endforelse
</div>
