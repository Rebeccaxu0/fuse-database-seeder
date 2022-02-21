<?php

namespace App\Http\Livewire\Facilitator;

use app\Models\ChallengeVersion;
use app\Models\User;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Support\Facades\Auth;
use Livewire\Component;

class StudioActivityPage extends Component
{
    public Collection $artifacts;
    public Collection $challenges;
    public Collection $ideas;
    public Collection $students;
    public ChallengeVersion $activeChallenge;
    public User $activeStudent;

    protected $listeners = ['activateChallenge', 'activateStudent'];

    public function activateChallenge(int $id)
    {
        $this->activeChallenge = $this->challenges->find($id);
        $this->populateArtifacts();
    }

    public function activateStudent(int $id)
    {
        $this->activeStudent = $this->students->find($id);
        $this->populateChallenges();
        $this->populateArtifacts();
        $this->populateIdeas();
    }

    public function mount()
    {
        $this->students
            = Auth::user()
                ->activeStudio
                ->students()
                ->with('artifacts', 'startedLevels', 'startedLevels.challengeVersion')
                ->orderBy('full_name')
                ->get();
        if ($this->students->count()) {
            $this->activeStudent = $this->students->first();
            $this->populateIdeas();
            $this->populateChallenges();
            $this->populateArtifacts();
        }
    }

    public function render()
    {
        return view('livewire.facilitator.studio-activity-page');
    }

    private function populateArtifacts()
    {
        $levelIds = ! isset($this->activeChallenge) ? [] :
            $this->challenges
                 ->find($this->activeChallenge)
                 ->levels
                 ->keyBy('id')
                 ->keys()
                 ->all();
        $this->artifacts
            = $this->students
                   ->find($this->activeStudent)
                   ->artifacts
                   ->where('artifactable_type', 'level')
                   ->whereIn('artifactable_id', $levelIds);
    }

    private function populateChallenges()
    {
        $challengeVersion = function ($level, $key) {
            return $level->challengeVersion;
        };
        $this->challenges = $this ->activeStudent
                                  ->startedLevels
                                  ->map($challengeVersion)
                                  ->unique()
                                  ->sortBy('name');

        if ($this->challenges->count()) {
            $this->activeChallenge = $this->challenges->first();
        }
        else {
            unset($this->activeChallenge);
        }
    }

    private function populateIdeas()
    {
        $this->ideas = $this->activeStudent->ideas;
    }
}