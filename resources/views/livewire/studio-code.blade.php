<div>
  {!! __("Your Studio Code is '<span class='font-bold uppercase'>:code</span>'", ['code' => $studio->join_code]) !!}
  <button wire:click="setNewStudioCode">{{ __('Change your code') }}</button>
</div>
