<?php

namespace App\Http\Livewire\Facilitator;

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
        return view('livewire.facilitator.studio-code');
    }
}
