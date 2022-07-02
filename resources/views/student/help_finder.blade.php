<x-app-layout>

    <x-slot name="title">{{ __('Help Finder') }}</x-slot>

    <x-slot name="header">{{ __('Help Finder') }}</x-slot>

    <x-challenge-gallery-menu />

    <div class="bg-neutral-100">
        <ul id="icon-key" class="mb-2 pb-2 border-b block w-full long_pulse1 clearfix font-semibold">
            <li class="list-none inline-block">
                <span class="inline-block activity-icon level-1">
                    <span>1</span>
                </span>
                <span class="inline-block activity-icon level-2">
                    <span>2</span>
                </span>
                <span class="inline-block activity-icon level-3">
                    <span>3</span>
                </span>
                <span class="inline-block activity-icon level-4">
                    <span>4</span>
                </span>
                <span class="inline-block activity-icon level-5">
                    <span>5</span>
                </span>
                <span class="key-text">= Level Completed<span>
            </li>
            <li class="list-none inline-block">
                <span class="inline-block activity-icon">
                    <span>&nbsp;</span>
                </span>
                <span class="key-text">= Started the Challenge<span>
            </li>
            <li class="list-none inline-block">
                <span class="inline-block activity-icon active active-3">
                    <span>&nbsp;</span>
                </span>
                <span class="key-text">= Active Now<span>
            </li>
        </ul>

        <div class="p-8 grid md:grid-cols-2 lg:grid-cols-3 gap-4">
            @forelse ($studio->activeChallenges() as $challengeVersion)
            <x-help-finder-tile :challengeVersion="$challengeVersion" :studio="$studio" />
        @empty
            <p class="col-span-full">{{ __('No Challenges. Please ask your facilitator to allow challenges.') }}</p>
        @endforelse
        </div>
    </div>
</x-app-layout>
