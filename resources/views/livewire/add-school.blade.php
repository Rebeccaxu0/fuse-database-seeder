<div class="relative">
  @livewire('school-search-bar')

  @foreach ($selectedschools as $id => $school)
  <div><input type="hidden" name="schoolsToAdd[]" value="{{ $id }}">({{ $school['name'] }}) <span wire:click="removeSchool({{ $id }})">remove</span></div>
  @endforeach
</div>

