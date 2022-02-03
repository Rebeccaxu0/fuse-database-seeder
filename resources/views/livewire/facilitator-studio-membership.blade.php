<div>
  <h2>{{ __('Students (:count)', ['count' => $students->count()])}}</h2>
  <div class="grid lg:grid-cols-2">
    @forelse ($students as $student)
    <div class="border rounded-xl px-4 py-2 relative">
      <span class="font-bold">{{ $student->full_name }}</span> <span>{{ $student->name }}</span>
      <div class="absolute right-0 top-0 bottom-0">
        <livewire:student-edit-modal :student="$student" :wire:key="'edit-' . $student->id" />
        <livewire:student-delete-modal :student="$student" :wire:key="'delete-' . $student->id" />
      </div>
    </div>
    @empty
    {{ __('Empty Studio.') }}
    @endforelse
  </div>
  <livewire:add-student-to-studio-by-search />

  <h2>{{ __('Facilitators (:count)', ['count' => $facilitators->count()])}}</h2>
  <div class="grid md:grid-cols-2">
    @forelse ($facilitators as $facilitator)
    <div>{{ $facilitator->name }}</div>
    @empty
    {{ __('Empty Studio.') }}
    @endforelse
  </div>
</div>

