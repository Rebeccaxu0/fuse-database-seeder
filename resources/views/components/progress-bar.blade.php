<div class="flex gap-6 h-full rounded-lg overflow-clip">
    @foreach ($challengeVersion->levels->sortBy('level_number') as $level)
        <x-progress-bar-level-status :interactive="$interactive" :level="$level" :user="$user" />
    @endforeach
</div>
