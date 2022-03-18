<?php

namespace App\Http\Livewire;

use Livewire\Component;

class NewIdea extends Component
{
    public bool $showModalFlag = false;

    public function render()
    {
        return view('livewire.new-idea');
    }
}
