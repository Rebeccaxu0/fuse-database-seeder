@props(['gallery' => true])

<div class="@if($gallery)aspect-video @endif w-full rounded-lg bg-gradient-to-t from-fuse-teal to-fuse-teal-dk-800 text-white min-h-[5rem]">
    @if ($students->count() > 0)
    <ul class="flex flex-wrap py-2 px-2 overflow-y-scroll items-center justify-items-center">
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
    @elseif (! $gallery)
    <div class="text-center pt-8">{{ __('No one else yet.') }}</div>
    @endif
</div>
