<ol {{ $attributes->merge(['class' => 'my-2 mx-[1px] flex gap-6 rounded-lg overflow-x-hidden']) }} >
@foreach ($levels as $level)
    <li class="mt-0 -ml-2 -mr-2 h-full flex-1 inline-block -skew-x-45
      @if ($level->status == 'completed') bg-fuse-green
      @elseif ($level->status == 'started')
          [background:repeating-linear-gradient(90deg,#2fc049_0_1rem,#b5edbf_1rem_2rem)]
      @else bg-zinc-300
      @endif">
        @if ($interactive)
        <a href="{{ route('student.level', ['challengeVersion' => $challengeVersion, 'level' => $level]) }}">
        @endif
              <span class="sr-only">{{ __('Level :number', ['number' => $level->level_number]) }}</span>
        @if ($interactive)
        </a>
        @endif
    </li>
@endforeach
</ol>
