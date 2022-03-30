<section {{ $attributes->merge(['class' => 'bg-fuse-teal-dk text-white flex flex-col items-center p-8']) }}>
  {{-- Background slideshow --}}
  {{-- if no levels started --}}
  @if (false)
    {{ __('Try a new challenge') }}
  @else
  <div class="text-xs">{{ __('You last worked on:') }}</div>
  <div class="text-xl">
    {{ $buttonText }}
  </div>
  @endif
  <a href="{{ $buttonLink }}" class="btn">
    {{ __('Explore challenges') }}
  </a>
</section>
