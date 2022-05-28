<div class="p-4 mb-2 relative rounded-lg bg-white w-full shadow-tile flow-root">
    <span class="absolute right-0 top-0 mt-1 mr-2 text-xs">
        {{ $timeAgo }} ({{ $activity->created_at->format('Y-m-d') }})
    </span>
    <livewire:student.activity-artifact :artifact="$activity" :studio="$studio" />
    <ul>
    @foreach ($activity->users->sortBy('name') as $user)
        @break($loop->index > 2)
        <li class="list-none m-0">
          <a href="{{ route('student.their_stuff', $user) }}">
            <x-avatar :user="$user" class="h-7 w-7 mr-2" /> {{ $user->firstName() }} {{ $user->abbreviatedLastName() }}
          </a>
          @if ($loop->index == 2 && $loop->count > 3)
          {!! __(', and <span title=":team">:remaining more</span>', ['remaining' => $loop->count - 3, 'team' => $activity->users->implode('full_name', ', ')]) !!}
          @endif
        </li>
    @endforeach
    <ul>
    <div class="absolute bottom-0 left-0 m-4">
        <x-icon icon="{{ $activity->type }}" alt="{{ __($activity->type) }}" displayOverride="true" class="block text-fuse-teal-dk-500" />
        @if ($activity->level->levelable::class === Idea::class)
            <div>
              <x-icon icon="idea" viewBox="60.4 90.6" fill="currentColor" alt="{{ __('idea') }}" class="text-orange-500" />
                {{ __('Idea') }}
            </div>
            <div class="text-slate-400 text-xl">
              {{ $activity->level->levelable->name }}
            </div>
        @else
            <div class="text-blue-400 text-xl font-medium uppercase -mb-2">
              {{ __('Level :number', ['number' => $activity->level->level_number]) }}
            </div>
            <div class="text-slate-400 text-2xl font-medium">
              {{-- $activity->level->levelable->challenge->name --}}
            </div>
        @endif
    </div>
</div>

