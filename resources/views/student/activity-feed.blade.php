<section {{ $attributes->merge() }}>
  <h2>{{ __('Activity Feed') }}</h2>
  <div class="bg-slate-300 py-3 px-3 max-h-96 min-h-[12rem] sm:max-h-screen overflow-scroll">
      @foreach ($studentActivity as $activity)
          @if ($activity::class == 'App\Models\Start')
              <x-student.activity-feed-start :start="$activity" />
          @else
              <livewire:student.activity-artifact :artifact="$activity" :studio="$studio" />
          @endif
      @endforeach
  </div>
</section>
