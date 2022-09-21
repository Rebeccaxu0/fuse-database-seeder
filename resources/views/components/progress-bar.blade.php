<ol {{ $attributes->merge(['class' => 'my-2 mx-[1px] flex gap-6 rounded-lg overflow-x-hidden w-full bg-white']) }} >
@foreach ($levels as $level)
    <li class="mt-0 -ml-2 -mr-2 h-full flex-1 inline-block -skew-x-45
      @if ($level->status == 'completed')
          bg-[#2fc049]
      @elseif ($level->status == 'started')
          [background:repeating-linear-gradient(90deg,#2fc049_0_1rem,#b5edbf_1rem_2rem)]
      @else
          bg-zinc-300
      @endif">
        @if ($interactive)
        <a class="block w-full h-full" href="{{ route('student.level', ['challengeVersion' => $levelable, 'level' => $level]) }}">
        @endif
              <span class="sr-only">{{ __('Level :number', ['number' => $level->level_number]) }}</span>
        @if ($interactive)
        </a>
        @endif
    </li>
@endforeach
</ol>

