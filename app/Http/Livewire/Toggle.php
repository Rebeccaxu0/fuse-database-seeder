<?php

namespace App\Http\Livewire;

use Livewire\Component;

class Toggle extends Component
{
    public $is_active;

    public function mount() {
        $this->is_active = false;
    }

    public function toggle()
    {
      // Implement this and call parent::toggle();
      $this->is_active = ! $this->is_active;
    }

    public function render()
    {
        return view('livewire.toggle');
    }
}
