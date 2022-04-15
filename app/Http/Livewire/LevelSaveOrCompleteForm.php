<?php

namespace App\Http\Livewire;

use Livewire\Component;

class LevelSaveOrCompleteForm extends Component
{
    public int $level_id;

    public function mount()
    {
    }

    public function render()
    {
        return view('livewire.level-save-or-complete-form');
    }
}
