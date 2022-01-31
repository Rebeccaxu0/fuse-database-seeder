<div>
  <h2>{{ __('Students (:count)', ['count' => $students->count()])}}</h2>
  <div>
    @forelse ($students as $student)
    <div class="border rounded-xl px-4 py-2">
      <span class="font-bold">{{ $student->full_name }}</span> <span>{{ $student->name }}</span>
      <livewire:student-edit-modal :student="$student" :wire:key="'edit-' . $student->id" />
    </div>
    <livewire:student-delete-modal :student="$student" :wire:key="'delete-' . $student->id" />
    @empty
    {{ __('Empty Studio.') }}
    @endforelse
  </div>

  <h2>{{ __('Facilitators (:count)', ['count' => $facilitators->count()])}}</h2>
  <div>
    @forelse ($facilitators as $facilitator)
    <div>{{ $facilitator->name }}</div>
    @empty
    {{ __('Empty Studio.') }}
    @endforelse
  </div>
</div>

