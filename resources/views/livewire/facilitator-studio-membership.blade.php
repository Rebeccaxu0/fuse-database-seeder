<div>
  <h2 class="mb-8 text-left">{{ __('Students (:count)', ['count' => $students->count()])}}</h2>
  <div class="grid lg:grid-cols-2 gap-4">
    @forelse ($students as $student)
    <div class="border rounded-xl px-4 py-2 relative">
      <span class="font-bold">{{ $student->full_name }}</span> <span>{{ $student->name }}</span>
      <div class="absolute right-0 top-0 bottom-0">
        <livewire:student-edit-modal :student="$student" :wire:key="'edit-' . $student->id" />
        <livewire:student-delete-modal :student="$student" :wire:key="'delete-' . $student->id" />
      </div>
    </div>
    @empty
    {{ __('No Students') }}
    @endforelse
  </div>
  <livewire:add-student-to-studio-by-search />

  <h2 class="mb-8 text-left">{{ __('Facilitators (:count)', ['count' => $facilitators->count()])}}</h2>
  <div class="grid md:grid-cols-2 gap-4">
    @forelse ($facilitators as $facilitator)
    <div class="border rounded-xl px-4 py-2 relative">
      <span class="font-bold">{{ $facilitator->full_name }}</span> <span>{{ $facilitator->name }}</span> <span>&lt;{{ $facilitator->email }}&gt;</span>
      <div class="absolute right-0 top-0 bottom-0">
        <!-- <livewire:student&#45;edit&#45;modal :student="$facilitator" :wire:key="'edit&#45;' . $facilitator&#45;>id" /> -->
        <!-- <livewire:student&#45;delete&#45;modal :student="$facilitator" :wire:key="'delete&#45;' . $facilitator&#45;>id" /> -->
      </div>
    </div>
    @empty
    {{ __('No Facilitators') }}
    @endforelse
  </div>
</div>

