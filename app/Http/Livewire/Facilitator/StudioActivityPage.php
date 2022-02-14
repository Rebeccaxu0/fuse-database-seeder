<?php

namespace App\Http\Livewire\Facilitator;

use App\Models\Artifact;
use App\Models\ChallengeVersion;
use App\Models\Studio;
use App\Models\User;
use Illuminate\Support\Facades\Auth;
use Livewire\Component;

class StudioActivityPage extends Component
{
    public $artifacts;
    public $challenges;
    public $students;
    public int $activeStudent;
    public int $activeChallenge;
    public Studio $studio;

    protected $listeners = ['activateChallenge', 'activateStudent'];

    public function activateChallenge(int $key)
    {
        $this->activeChallenge = $key;
        $this->artifacts = $this->students[$this->activeStudent]->artifacts;
    }

    public function activateStudent(int $key)
    {
        $this->activeStudent = $key;
        $this->activeChallenge = 0;
        $this->artifacts = $this->students[$key]->artifacts;
    }

    public function mount()
    {
        $this->studio = Auth::user()->activeStudio;
        $this->challenges = $this->studio
                                 ->activeChallenges()
                                 ->orderBy('name')
                                 ->get();
        $this->students = $this->studio
            ->students()
            ->with('artifacts')
            ->orderBy('full_name')
            ->get();
        $this->activeStudent = 0;
        $this->activeChallenge = 0;
        $this->artifacts = $this->students[0]->artifacts;
    }

    public function render()
    {
        return view('livewire.facilitator.studio-activity-page');
    }
}
