<div>
  <h2 class="mb-8 text-left">{{ __('Students (:count)', ['count' => $students->count()]) }}</h2>
  <div class="grid lg:grid-cols-2 gap-4">
    @forelse ($students as $student)
    <div class="border rounded-xl px-4 py-2 relative">
      <span class="font-bold">{{ $student->full_name }}</span> <span>{{ Str::of($student->name)->limit(20) }}</span>
      <div class="absolute right-0 top-0 bottom-0">
        <livewire:facilitator.user-edit-modal :studio="$studio" :user="$student" :wire:key="'edit-' . $student->id" />
        <livewire:facilitator.student-remove-from-studio-confirm :studio="$studio" :student="$student" :wire:key="'delete-' . $student->id" />
      </div>
    </div>
    @empty
    {{ __('No Students') }}
    @endforelse
  </div>
  <livewire:facilitator.add-student-to-studio-by-search :studio="$studio" />
  <livewire:facilitator.add-student-to-studio-by-creation :studio="$studio" />
  <livewire:facilitator.remove-all-students-from-studio :studio="$studio" />

  <h2 class="mb-8 text-left">{{ __('Facilitators (:count)', ['count' => $facilitators->count()]) }}</h2>
  <div class="grid lg:grid-cols-2 gap-4">
    @forelse ($facilitators as $facilitator)
    <div class="border rounded-xl px-4 py-2 relative">
      <span class="font-bold">{{ $facilitator->full_name }}</span> <span>{{ $facilitator->name }}</span> <span>&lt;{{ $facilitator->email }}&gt;</span>
      <div class="absolute right-0 top-0 bottom-0 rounded-xl overflow-hidden">
        <livewire:facilitator.user-edit-modal :studio="$studio" :user="$facilitator" :wire:key="'edit-' . $facilitator->id" />
      </div>
    </div>
    @empty
    {{ __('No Facilitators') }}
    @endforelse
  </div>
</div>

