<div {{ $attributes->merge(['class' => 'bg-neutral-100 rounded-xl p-4 shadow']) }}>
    @forelse ($startedChallengeVersions as $challengeVersion)
        <h3 class="text-fuse-teal mb-0">
            {{ $challengeVersion->challenge->name }}
        </h3>
        <x-progress-bar :user="$user" :interactive="true" :levelable="$challengeVersion" class="h-4 my-0" />
    @empty
    {{ __('Nothing started!') }} <a href="/challenges">{{ __('Choose a challenge.') }}</a>
    @endforelse
</div>
