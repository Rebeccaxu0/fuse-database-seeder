@if ($interactive)
<a href="{{ route('student.level', ['challengeVersion' => $level->challengeVersion, 'level' => $level]) }}">
@endif
    <span>
        Level {{ $level->level_number }}
        <!-- green for complete, striped for in-progress, grey for unstarted -->
    </span>
@if ($interactive)
</a>
@endif
