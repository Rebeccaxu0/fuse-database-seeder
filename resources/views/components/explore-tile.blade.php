@props(['started' => 0, 'total' => 0])
<div>
  {{ __('You have tried :started/:total challenges', ['started' => $started, 'total' => $total]) }}
  <a href="{{ route('student.challenges') }}">
    Explore
  </a>
</div>
