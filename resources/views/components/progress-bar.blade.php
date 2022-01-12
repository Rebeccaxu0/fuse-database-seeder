<div>
  Progress for {{ $challengeVersion->name }} ({{ $challengeVersion->id }})
  @foreach ($challengeVersion->levels as $level)
    <x-progress-bar-level-status :challengeVersion="$challengeVersion" :level="$level"/>
  @endforeach
</div>