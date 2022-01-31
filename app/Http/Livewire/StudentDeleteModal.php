<?php

namespace App\Http\Livewire;

use App\Models\User;
use Livewire\Component;

class StudentDeleteModal extends Component
{
    public bool $showDeleteModal = false;
    public User $student;

    public function submit() {
        $this->student->delete();
        $this->emitUp('updateStudents');
        $this->showDeleteModal = false;
    }

    public function render()
    {
        return view('livewire.student-delete-modal');
    }
}

