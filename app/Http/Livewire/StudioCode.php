<?php

namespace App\Http\Livewire;

use App\Models\Studio;
use Livewire\Component;

class StudioCode extends Component
{
    public Studio $studio;

    public function setNewStudioCode()
    {
        $this->studio->setNewStudioCode();
    }

    public function render()
    {
        return view('livewire.studio-code');
    }
}
