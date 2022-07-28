<div {{ $attributes->merge(['class' => 'bg-neutral-100 rounded-xl p-4 shadow']) }}>
    @forelse ($startedChallengeVersions as $challengeVersion)
        <div class="text-fuse-teal font-bold mt-4 first:mt-0">
            {{ $challengeVersion->challenge->name }}
        </div>
        <x-progress-bar :user="$user" :interactive="true" :levelable="$challengeVersion" class="h-4 my-0" />
    @empty
    {{ __('Nothing started!') }} <a href="/challenges">{{ __('Choose a challenge.') }}</a>
    @endforelse
</div>
