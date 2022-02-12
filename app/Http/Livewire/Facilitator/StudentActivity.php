<?php

namespace App\Http\Livewire\Facilitator;

use App\Models\User;
use Livewire\Component;

class StudentActivity extends Component
{
    public User $student;
    public bool $active = false;


    public function activate()
    {
        $this->active = true;
    }

    public function deactivate()
    {
        $this->active = false;
    }

    public function render()
    {
        return view('livewire.facilitator.student-activity');
    }

    protected function getListeners()
    {
      return [
        "activateStudent{$this->student->id}" => 'activate',
        "deactivateStudent{$this->student->id}" => 'deactivate',
      ];
    }
}

