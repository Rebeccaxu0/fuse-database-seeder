<a href="{{ route('student.level', ['challengeVersion' => $level->challengeVersion, 'level' => $level]) }}">
  <div>
    Level {{ $level->level_number }}
    <!-- green for complete, striped for in-progress, grey for unstarted -->
  </div>
</a>