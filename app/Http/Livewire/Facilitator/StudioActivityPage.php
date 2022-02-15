<?php

namespace App\Http\Livewire\Facilitator;

use App\Models\ChallengeVersion;
use App\Models\Studio;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Support\Facades\Auth;
use Livewire\Component;

class StudioActivityPage extends Component
{
    public Collection $artifacts;
    public Collection $challenges;
    public Collection $ideas;
    public Collection $students;
    public int $activeStudent;
    public int $activeChallenge;
    public Studio $studio;

    protected $listeners = ['activateChallenge', 'activateStudent'];

    public function activateChallenge(int $key)
    {
        $this->activeChallenge = $key;
        $this->populateArtifacts();
    }

    public function activateStudent(int $key)
    {
        $this->activeStudent = $key;
        $this->activeChallenge = 0;
        $this->populateIdeas();
        $this->populateArtifacts();
    }

    public function mount()
    {
        $this->studio = Auth::user()->activeStudio;
        $this->students = $this->studio
                               ->students()
                               ->with('artifacts')
                               ->orderBy('full_name')
                               ->get();
        $this->activeStudent = 0;
        $this->populateIdeas();
        // TODO: populate challenges based on user level and idea starts.
        $this->challenges = ChallengeVersion::with('levels')
                                 ->orderBy('name')
                                 ->get();
        $this->activeChallenge = 0;
        $this->populateArtifacts();
    }

    public function render()
    {
        return view('livewire.facilitator.studio-activity-page');
    }

    private function populateArtifacts()
    {
        $levels
            = $this->challenges[$this->activeChallenge]
                   ->levels
                   ->keyBy('id')
                   ->keys()
                   ->all();
        $this->artifacts
            = $this->students[$this->activeStudent]
                ->artifacts
                ->where('artifactable_type', 'level')
                ->whereIn('artifactable_id', $levels);
    }

    private function populateIdeas()
    {
        $this->ideas
          = $this->students[$this->activeStudent]->ideas;
    }
}
