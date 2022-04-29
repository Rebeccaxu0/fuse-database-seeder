<?php

namespace App\Http\Livewire;

use Livewire\Component;

class Toggle extends Component
{
    public bool $is_active = false;
    public string $event = 'toggle';
    public string $label = '';

    public function mount() {
        $this->is_active = false;
    }

    public function toggle()
    {
      $this->is_active = ! $this->is_active;
      $this->emitUp($this->event);
    }

    public function render()
    {
        return view('livewire.toggle');
    }
}
