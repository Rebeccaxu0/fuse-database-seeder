<div class="flex gap-6 h-full rounded-lg overflow-clip">
    @foreach ($levels as $level)
        <div aria-label="{{ __('Level :number', ['number' => $level->level_number]) }}" class="progress-bar-segment {{ $level->status }}">@if ($interactive)
        <a href="{{ route('student.level', ['challengeVersion' => $level->challengeVersion, 'level' => $level]) }}" class="block w-full h-full" ></a>
        @endif</div>
    @endforeach
</div>
