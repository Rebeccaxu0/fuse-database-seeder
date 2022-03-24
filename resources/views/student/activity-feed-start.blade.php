<div class="p-4 mb-2 relative rounded-lg shadow-lg bg-white uppercase font-light text-sm">
    <span class="absolute right-0 top-0 mt-1 mr-2 text-xs">
        {{ $timeAgo }} ({{ $start->created_at->format('Y-m-d') }})</span>
    </span>
    <x-avatar :user="$start->user" class="h-7 w-7 mr-2" />
    @if ($start->startable_type = 'level')
        {!! __('<a href=":user_link">:name</a> started <span class="font-semibold">:challenge</span> <a href=":level_link">level :level_number</a>',
    [
      'user_link' => route('student.their_stuff', $start->user),
      'name' => $name,
      'challenge' => $start->startable->challengeVersion->challenge->name,
      'level_link' => route('student.level', [$start->startable->challengeVersion, $start->startable->level_number]),
      'level_number' => $start->startable->level_number]) !!}
    @else
        {{ __(':name started idea :idea_name', ['name' => $name, 'idea_name' => $start->startable->name]) }}
    @endif
</div>
