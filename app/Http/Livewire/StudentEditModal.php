<?php

namespace App\Http\Livewire;

use App\Models\User;
use Livewire\Component;

class StudentEditModal extends Component
{
    public $showEditModal = false;
    public User $student;
    public string $name;

    public function mount() {
        $this->name = $this->student->name;
    }

    public function submit() {
        $this->student->name = $this->name;
        $this->student->save();

        $this->emitUp('updateStudents');
        $this->showEditModal = false;
    }

    public function render()
    {
        return view('livewire.student-edit-modal');
    }
}
