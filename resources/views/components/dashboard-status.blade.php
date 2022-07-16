<section {{ $attributes->merge(['class' => 'rounded-xl bg-fuse-teal-dk text-white flex flex-col items-center p-8']) }}>
  @if ($explore)
    {{ __('Try a new challenge') }}
  @else
  <div class="text-xs">{{ __('You last worked on:') }}</div>
  <h3 class="text-white">{{ $mostRecent }}</h3>
  @endif
  <a href="{{ $buttonLink }}" class="btn">
    {{ $buttonText }}
  </a>
</section>
