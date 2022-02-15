<div aria-label="{{ __('Level :number', ['number' => $level->level_number]) }}"
     class="progress-bar-segment {{ $status }}">
     {{ $level->id }}
    @if ($interactive)<a href="{{ route('student.level', ['challengeVersion' => $level->challengeVersion, 'level' => $level]) }}" class="block w-full h-full" ></a>@endif
</div>
