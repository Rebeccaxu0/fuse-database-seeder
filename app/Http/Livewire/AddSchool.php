<?php

namespace App\Http\Livewire;

use App\Models\School;
use Livewire\Component;

class AddSchool extends Component
{
    public $selectedschools = [];

    protected $listeners = ['schoolSelected' => 'addSchool'];

    public function addSchool(School $school)
    {
      $this->selectedschools[$school->id] = ['name' => $school->name];
    }

    public function removeSchool($id)
    {
      unset($this->selectedschools[$id]);
    }

    public function render()
    {
        return view('livewire.add-school');
    }
}
