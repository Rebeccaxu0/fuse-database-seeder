<?php

namespace App\Http\Livewire\Facilitator;

use App\Models\Studio;
use App\Models\User;
use Livewire\Component;

class StudentRemoveFromStudioConfirm extends Component
{
    public bool $showDeleteModal = false;
    public Studio $studio;
    public User $student;

    public function mount(Studio $studio)
    {
        $this->studio = $studio;
    }

    public function submit() {
        $this->studio->students()->detach($this->student);

        $this->emitUp('updateStudents');
        $this->showDeleteModal = false;
    }

    public function render()
    {
        return view('livewire.facilitator.student-remove-from-studio-confirm');
    }
}

