<?php

namespace App\Http\Livewire\Facilitator;

use App\Models\ChallengeVersion;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Support\Facades\Auth;
use Livewire\Component;

class StudioActivityPage extends Component
{
    public Collection $artifacts;
    public Collection $challenges;
    public Collection $ideas;
    public Collection $students;
    public int $activeStudentId;
    public int $activeChallengeId;

    protected $listeners = ['activateChallenge', 'activateStudent'];

    public function activateChallenge(int $id)
    {
        $this->activeChallengeId = $id;
        $this->populateArtifacts();
    }

    public function activateStudent(int $id)
    {
        $this->activeStudentId = $id;
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
        $this->activeStudentId
            = $this->students->first() ? $this->students->first()->id : 0;
        $this->populateIdeas();
        $this->populateChallenges();
        $this->populateArtifacts();
    }

    public function render()
    {
        return view('livewire.facilitator.studio-activity-page');
    }

    private function populateArtifacts()
    {
        $levelIds = ! $this->activeChallengeId ? [] :
            $this->challenges
                 ->find($this->activeChallengeId)
                 ->levels
                 ->keyBy('id')
                 ->keys()
                 ->all();
        $this->artifacts
            = $this->students
                   ->find($this->activeStudentId)
                   ->artifacts
                   ->where('artifactable_type', 'level')
                   ->whereIn('artifactable_id', $levelIds);
    }

    private function populateChallenges()
    {
        $challengeVersion = function ($level, $key) {
            return $level->challengeVersion;
        };
        $this->challenges
            = $this
                ->students
                ->find($this->activeStudentId)
                ->startedLevels
                ->map($challengeVersion)
                ->unique()
                ->sortBy('name');

        $this->activeChallengeId
            = $this->challenges->first() ? $this->challenges->first()->id : 0;
    }

    private function populateIdeas()
    {
        $this->ideas
            = $this->students->find($this->activeStudentId)->ideas;
    }
}
