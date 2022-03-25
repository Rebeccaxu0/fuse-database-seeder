<div class="p-4 mb-2 relative rounded-lg shadow-lg bg-white uppercase font-light text-sm">
    <span class="absolute right-0 top-0 mt-1 mr-2 text-xs">
        {{ $timeAgo }} ({{ $activity->created_at->format('Y-m-d') }})
    </span>
    <a href="{{ route('student.their_stuff', $activity->user) }}">
      <x-avatar :user="$activity->user" class="h-7 w-7 mr-2" /> {{ $activity->user->firstName() }} {{ $activity->user->abbreviatedLastName() }}
    </a>
    @if ($activity->startable_type = 'level')
        {!! __('started <span class="font-semibold">:challenge</span> <a href=":level_link">level :level_number</a>',
    [
      'challenge' => $activity->startable->challengeVersion->challenge->name,
      'level_link' => route('student.level', [$activity->startable->challengeVersion, $activity->startable->level_number]),
      'level_number' => $activity->startable->level_number]) !!}
    @else
        {{ __(':name started idea :idea_name', ['name' => $name, 'idea_name' => $activity->startable->name]) }}
    @endif
</div>
