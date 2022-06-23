<div>
  <div class="text-xl text-fuse-teal-dk mb-2">
    {!! __("Your Studio Code is '<span class='font-bold uppercase'>:code</span>'", ['code' => $studio->join_code]) !!}
  </div>
  <button class="btn" wire:click="setNewStudioCode">{{ __('Refresh your code') }}</button>
</div>
