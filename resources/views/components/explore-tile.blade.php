@props(['started' => 0, 'total' => 0])
<div>
  {{ __('You have tried :started/:total challenges', ['started' => $started, 'total' => $total]) }}
  <a href="{{ route('challenges') }}">
    Explore
  </a>
</div>