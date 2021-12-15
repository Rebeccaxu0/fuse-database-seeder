<div class="relative">
  @livewire('user-search-bar')

  @foreach ($selectedusers as $id => $user)
  <div><input type="hidden" name="superFacilitatorsToAdd[]" value="{{ $id }}">{{$user['full_name']}} ({{ $user['name'] }}) <span wire:click="removeUser({{ $id }})">remove</span></div>
  @endforeach
</div>
