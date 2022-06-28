<?php

namespace App\Http\Livewire\Facilitator;

use app\Models\Studio;
use app\Models\User;
use DateTime;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Support\Facades\Auth;
use Livewire\Component;

class StudioActivityPage extends Component
{
    public Collection $artifacts;
    public Collection $challenges;
    public Collection $ideas;
    public Collection $students;
    public $activeChallenge = null;
    public Studio $studio;
    public User $activeStudent;
    public string $startDate = '';
    public string $endDate = '';

    protected $listeners = ['activateChallenge', 'activateStudent'];
    protected $queryString = [
      'startDate' => ['except' => 0, 'as' => 'start'],
      'endDate' => ['except' => 0, 'as' => 'end'],
    ];

    public function activateChallenge(string $levelableType, int $levelableId)
    {
        if ($levelableType == 'idea') {
            $this->activeChallenge = $this->ideas->find($levelableId);
        }
        else {
            $this->activeChallenge = $this->challenges->find($levelableId);
        }
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
        if (! $this->startDate) {
            // Default to start of academic year - previous Aug 1.
            $now = new DateTime();
            $start = new DateTime(date('Y') . '-08-01');
            if ($start > $now) {
                $start->modify('-1 year');
            }
            $this->startDate = $start->format('Y-m-d');
        }
        if (! $this->endDate) {
            $this->endDate = date('Y-m-d');
        }
        $this->studio = Auth::user()->activeStudio;
        $eager = [
          'artifacts',
          'startedLevels',
        ];
        $this->students = $this->studio
                               ->students()
                               ->with($eager)
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
            $this->activeChallenge
                 ->levels
                 ->keyBy('id')
                 ->keys()
                 ->all();
        $this->artifacts
            = $this->activeStudent
                   ->artifacts
                   ->whereIn('level_id', $levelIds)
                   ->whereBetween('created_at', [$this->startDate . ' 00:00:00', $this->endDate . ' 23:59:59']);
    }

    private function populateChallenges()
    {
        $this->challenges = $this->activeStudent
                                 ->startedChallengeVersionLevels
                                 ->map(fn($level) => $level->levelable)
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
        if ($this->ideas->count() && ! $this->activeChallenge) {
            $this->activeChallenge = $this->ideas->first();
        }
    }
}
