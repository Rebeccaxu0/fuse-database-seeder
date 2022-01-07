<div class="relative">
  @livewire('district-search-bar')

  <div>
    <input type="hidden" name="districtsToAdd[]" value="{{ $selecteddistrict->id }}">{{ $selecteddistrict->name }} <span class="inline-flex"> <img wire:click="removeDistrict({{ $id }})" class="h-6 w-6" src="/deletetrash.png"> </span>
  </div>
</div>
