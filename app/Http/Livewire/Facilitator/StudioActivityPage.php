<?php

namespace App\Http\Livewire\Facilitator;

use App\Models\ChallengeVersion;
use app\Models\Studio;
use app\Models\User;
use DateTime;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Support\Collection as SCollection;
use Illuminate\Support\Facades\Gate;
use Livewire\Component;

class StudioActivityPage extends Component
{
    public Collection $artifacts;
    public Collection|SCollection $challenges;
    public Collection $ideas;
    public Collection $students;
    public $activeChallenge = null;
    public int $activeChallengeId = 0;
    public string $activeChallengeType = '0';
    public Studio $studio;
    public User $activeStudent;
    public int $activeStudentId = 0;
    public string $startDate = '';
    public string $endDate = '';

    protected $listeners = ['activateChallenge', 'activateStudent'];
    protected $queryString = [
        'activeChallengeId' => ['except' => 0, 'as' => 'cid'],
        'activeChallengeType' => ['except' => '0', 'as' => 'ct'],
        'activeStudentId' => ['except' => 0, 'as' => 'u'],
        'startDate' => ['except' => 0, 'as' => 'start'],
        'endDate' => ['except' => 0, 'as' => 'end'],
    ];

    public function activateChallenge(string $levelableType, int $levelableId)
    {
        $this->activeChallengeId = $levelableId;
        if ($levelableType == 'idea') {
            $this->activeChallengeType = 'i';
            $this->activeChallenge = $this->ideas->find($levelableId);
        }
        else {
            $this->activeChallengeType = 'c';
            $this->activeChallenge = $this->challenges->find($levelableId);
        }
        $this->populateArtifacts();
    }

    public function activateStudent(int $id, bool $reset = true)
    {
        $this->activeStudentId = $id;
        $this->activeStudent = $this->students->find($id);
        if ($reset) {
            $this->resetChallenges();
        }
        $this->populateChallenges();
        $this->populateArtifacts();
        $this->populateIdeas();
    }

    public function updatedEndDate($value)
    {
        $this->activateStudent($this->activeStudent->id, false);
    }

    public function updatedStartDate($value)
    {
        $this->activateStudent($this->activeStudent->id, false);
    }

    public function mount()
    {
        Gate::allowIf(auth()->user()->isFacilitator());

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
        $this->studio = auth()->user()->activeStudio;
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
            if ($this->activeStudentId) {
                $this->activeStudent = $this->students->find($this->activeStudentId);
            }
            else {
                $this->activeStudent = $this->students->first();
            }
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
        $levelIds = ! isset($this->activeChallenge)
            ? []
            : $this->activeChallenge
                ->levels
                ->keyBy('id')
                ->keys()
                ->all();
        $this->artifacts
            = $this->activeStudent
                ->artifacts()
                ->with(['level', 'level.levelable'])
                ->whereIn('level_id', $levelIds)
                ->whereBetween('created_at', [$this->startDate . ' 00:00:00', $this->endDate . ' 23:59:59'])
                ->get();
    }

    private function populateChallenges()
    {
        $artifactsChallenges = $this->activeStudent->artifacts
                                 ->reject(fn($artifact) => is_null($artifact->level->levelable))
                                 ->map(fn($artifact) => $artifact->level->levelable::class == ChallengeVersion::class ? $artifact->level->levelable : null)
                                 ->whereNotNull()
                                 ->reject(fn($levelable) => is_null($levelable))
                                 ->unique()
                                 ->sortBy('name');
        $startedChallenges = $this->activeStudent
                                 ->startedChallengeVersionLevels
                                 ->reject(fn($level) => is_null($level->levelable))
                                 ->map(fn($level) => $level->levelable::class == ChallengeVersion::class ? $level->levelable : null)
                                 ->whereNotNull()
                                 ->reject(fn($levelable) => is_null($levelable))
                                 ->unique()
                                 ->sortBy('name');

        $this->challenges = $artifactsChallenges->merge($startedChallenges);
        if ($this->challenges->count()) {
            if ($this->activeChallengeType == 'c') {
                $this->activeChallenge = $this->challenges->where('id', $this->activeChallengeId)->first();
            }
            else {
                $this->activeChallenge = $this->challenges->first();
            }
        }
        else {
          $this->resetChallenges();
        }
    }

    private function populateIdeas()
    {
        $this->ideas = $this->activeStudent->ideas;
        if ($this->ideas->count() && ! $this->activeChallenge) {
            if ($this->activeChallengeType == 'i') {
                $this->activeChallenge = $this->challenges->where('id', $this->activeChallengeId)->first();
            }
            else {
                $this->activeChallenge = $this->ideas->first();
            }
        }
    }

    private function resetChallenges()
    {
        unset($this->activeChallenge);
        $this->activeChallengeId = 0;
        $this->activeChallengeType = '0';
    }
}
