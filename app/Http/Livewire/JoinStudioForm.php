<?php

namespace App\Http\Livewire;

use Livewire\Component;

class JoinStudioForm extends Component
{
    public $showModalFlag = false;

    public function render()
    {
        return view('livewire.join-studio-form');
    }
}
