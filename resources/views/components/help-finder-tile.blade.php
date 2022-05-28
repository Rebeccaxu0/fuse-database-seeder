<div class="shadow-tile w-full relative rounded-lg p-4 text-left bg-white">
    <ul class="flex flex-wrap py-2 px-2 overflow-y-scroll aspect-video w-full rounded-lg flex items-center justify-items-center bg-gradient-to-t from-fuse-teal to-fuse-teal-dk-800 text-white">
        @foreach ($students as $student)
        <li class="list-none m-2">
            @if ($student->isOnline())
            <div class="activity-icon active active-{{ rand(0, 9) }}">
                @if ($completedLevel[$student->id])
                <span>{{ $completedLevel[$student->id] }}</span>
                @endif
            </div>
            @else
            <div class="activity-icon level-{{ $student->levelCompleted }}">
                @if ($completedLevel[$student->id])
                <span>{{ $completedLevel[$student->id] }}</span>
                @endif
            </div>
            @endif
            <div class="whitespace-nowrap text-sm">
                {{ $student->firstName() }} {{ $student->abbreviatedLastName() }}
            </div>
        </li>
        @endforeach
    </ul>
    <div class="mt-3 font-bold text-xl">
      {{ $challengeVersion->challenge->name }}
      <span class="uppercase text-sm font-light text-fuse-nav-blue">
        {{ $challengeVersion->gallery_note }}
      </span>
    </div>
    <div class="min-h-[4rem]">
      {{ $challengeVersion->blurb }}
    </div>
</div>

