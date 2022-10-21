<section class='rounded-xl bg-fuse-teal-dk text-white flex flex-col items-center p-8'>
  @if ($explore)
    <h3 class="text-white">{{ __('Try a new challenge') }}</h3>
  @else
  <div class="text-xs">{{ __('You last worked on:') }}</div>
  <h3 class="text-white">{{ $mostRecent }}</h3>
  <x-progress-bar :user="$user" :interactive="true" :levelable="$challengeVersion" class="h-4 my-0" />
  @endif
  <a href="{{ $buttonLink }}" class="btn">
    {{ $buttonText }}
  </a>
</section>
