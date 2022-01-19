<?php

namespace App\Http\Livewire;

use App\Models\Studio;
use Livewire\Component;

class AddStudio extends Component
{
    public $selectedstudios = [];

    protected $listeners = ['studioSelected' => 'addStudio'];

    public function addStudio(Studio $studio)
    {
        $this->selectedstudios[$studio->id] = ['name' => $studio->name];
    }

    public function removeStudio($id)
    {
        unset($this->selectedstudios[$id]);
    }

    public function render()
    {
        return view('livewire.add-studio');
    }
}
