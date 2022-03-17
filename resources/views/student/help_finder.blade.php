<x-app-layout>

    <x-slot name="title">{{ __('Help Finder') }}</x-slot>

    <x-slot name="header">{{ __('Help Finder') }}</x-slot>

    <x-challenge-gallery-menu />

    <ul id="icon-key" class="mb-2 long_pulse1 clearfix inline-block font-semibold">
      <li class="list-none inline-block">
          <span class="activity-icon level-1">
            <span>1</span>
          </span>
          <span class="activity-icon level-2">
            <span>2</span>
          </span>
          <span class="activity-icon level-3">
            <span>3</span>
          </span>
          <span class="activity-icon level-4">
            <span>4</span>
          </span>
          <span class="activity-icon level-5">
            <span>5</span>
          </span>
          <span class="key-text">= Level Completed<span>
      </li>
      <li class="list-none inline-block">
          <span class="activity-icon">
            <span>&nbsp;</span>
          </span>
          <span class="key-text">= Started the Challenge<span>
      </li>
      <li class="list-none inline-block">
          <span class="activity-icon active active-3">
            <span>&nbsp;</span>
          </span>
          <span class="key-text">= Active Now<span>
      </li>
    </ul>

    <div class="bg-slate-200 p-8 grid grid-cols-3 gap-4">
    @forelse ($challenges as $challengeVersion)
        <x-help-finder-tile :challengeVersion="$challengeVersion" :studio="$studio" />
    @empty
        <p class="col-span-full">{{ __('No Challenges. Please ask your facilitator to allow challenges.') }}</p>
    @endforelse
    </div>
</x-app-layout>
