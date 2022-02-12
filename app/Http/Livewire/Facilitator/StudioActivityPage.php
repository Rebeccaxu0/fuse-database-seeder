<?php

namespace App\Http\Livewire\Facilitator;

use App\Models\Studio;
use Illuminate\Support\Facades\Auth;
use Livewire\Component;

class StudioActivityPage extends Component
{
    public $students;
    public int $activeStudentId = 0;
    public Studio $studio;

    protected $listeners = ['activateStudent'];

    public function activateStudent(int $studentId)
    {
        $this->emit('deactivateStudent' . $this->activeStudentId);
        $this->emit('activateStudent' . $studentId);
        $this->activeStudentId = $studentId;
    }

    public function mount()
    {
        $this->studio = Auth::user()->activeStudio;
        $this->students = $this->studio
            ->students()
            ->orderBy('full_name')
            ->get();
        $this->activeStudentId = $this->students[0]->id;
    }

    public function render()
    {
        return view('livewire.facilitator.studio-activity-page');
    }
}
