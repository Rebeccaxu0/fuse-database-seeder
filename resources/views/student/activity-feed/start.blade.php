<div class="p-4 mb-2 relative rounded-lg shadow-lg bg-white font-light text-sm">
    <span class="absolute right-0 top-0 mt-1 mr-2 text-xs">
        {{ $timeAgo }} ({{ $activity->created_at->format('Y-m-d') }})
    </span>
    <a href="{{ route('student.their_stuff', $activity->user) }}">
      <x-avatar :user="$activity->user" class="h-7 w-7 mr-2" /> {{ $activity->user->firstName() }} {{ $activity->user->abbreviatedLastName() }}
    </a>
    @if ($activity->level->levelable::class == App\Models\Idea::class)
      {{ __(':name started idea :idea_name', ['name' => $name, 'idea_name' => $activity->level->levelable->name]) }}
    @else
        {!! __('started <span class="font-semibold">:challenge</span> <a href=":level_link">L:level_number</a>',
    [
      'challenge' => $activity->level->levelable->challenge->name,
      'level_link' => route('student.level', [$activity->level->levelable, $activity->level]),
      'level_number' => $activity->level->level_number]) !!}
    @endif
</div>
