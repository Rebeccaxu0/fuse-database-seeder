<div>
    <h2>
        {{ __('Also In Progress') }}
    </h2>
    @forelse ($challengeVersions as $challengeVersion)
        <h3>
            {{ $challengeVersion->challenge->name }}
        </h3>
        <x-progress-bar :interactive="true" :challengeVersion="$challengeVersion" class="h-4" />
    @empty
        {{ __('Nothing started! Choose a challenge.') }}
    @endforelse
</div>
