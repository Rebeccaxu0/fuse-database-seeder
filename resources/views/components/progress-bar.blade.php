<div class="flex gap-6 h-6 rounded-lg overflow-clip">
    @foreach ($challengeVersion->levels as $level)
        <x-progress-bar-level-status :interactive="$interactive" :level="$level" :user="$user" />
    @endforeach
</div>
