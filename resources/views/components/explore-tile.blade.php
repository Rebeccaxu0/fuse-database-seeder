<div {{ $attributes->merge(['class' => 'rounded-xl bg-neutral-100 shadow flex flex-col p-2 items-center justify-center']) }}>
  <div class="font-semibold">
    {!! __('You have tried <span class="text-xl font-bold">:started/:total</span> challenges', ['started' => $started, 'total' => $total]) !!}
  </div>
    <a class="btn" href="{{ route('student.challenges') }}">{{ __('Try More') }}</a>
</div>
