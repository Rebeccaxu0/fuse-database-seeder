@props(['challenges' => [(object) ['title' => 'test']]])
<div>
  <h2>
    {{ __('Also In Progress') }}
  </h2>
  @forelse ($challenges as $challenge)
    <h3>
      {{  $challenge->title  }}
    </h3>
    <x-progress-bar :challenge="$challenge" />
  @empty
  {{ __('Nothing started! Choose a challenge.') }}
  @endforelse
    <!-- Act only according to that maxim whereby you can, at the same time, will that it should become a universal law. - Immanuel Kant -->
</div>