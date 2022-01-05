<div class="relative">
  @livewire('school-search-bar')

  @foreach ($selectedschools as $id => $school)
  <div>
    <input type="hidden" name="schoolsToAdd[]" value="{{ $id }}">{{ $school['name'] }} <span class="inline-flex"> <img wire:click="removeUser({{ $id }})" class="h-6 w-6" src="/deletetrash.png"> </span>
  </div>
  @endforeach
</div>

