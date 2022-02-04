<?php

namespace App\Http\Livewire;

use App\Models\User;
use Illuminate\Support\Facades\Auth;
use Livewire\Component;

class StudentDeleteModal extends Component
{
    public bool $showDeleteModal = false;
    public User $student;

    public function submit() {
        $this->student->studios()->detach(Auth::user()->activeStudio->id);
        $this->emitUp('updateStudents');
        $this->showDeleteModal = false;
    }

    public function render()
    {
        return view('livewire.student-delete-modal');
    }
}

