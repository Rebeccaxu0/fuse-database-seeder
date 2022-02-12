<div class="cursor-pointer">
  <div wire:click="$emitUp('activateStudent', {{ $student->id }})" class="@if ($active) bg-fuse-green-100 @endif border rounded">
    {{ $student->full_name }} ({{ $student->name }}) @if ($active)<span class="float-right">&gt;</span>@endif
    </div>
    {{-- TODO: Show details here when active. See modals --}}
</div>
