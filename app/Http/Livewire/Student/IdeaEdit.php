<?php

namespace App\Http\Livewire\Student;

use App\Models\ChallengeVersion;
use App\Models\Idea;
use App\Models\Level;
use App\Models\User;
use Illuminate\Support\Facades\Auth;
use Livewire\Component;

class IdeaEdit extends Component
{
    public int $ideaId;
    public bool $showModalFlag = false;
    public bool $create = false;
    public bool $levelPage = false;
    public string $title = '';
    public string $body = '';
    public string $name = '';
    public $studioMembers;
    public $challengeVersions;
    public array $inspirations = [];
    public array $inspirationNames = [];
    public array $teammates = [];
    public array $teamNames = [];

    protected $rules = [
        'body' => 'required|string',
        'name' => 'required|string',
        'inspirations.*' => 'int|exists:App\Models\ChallengeVersion,id',
        'teammates.*' => 'int|exists:App\Models\User,id',
    ];

    public function mount($inspiration = null)
    {
        $user = Auth::user();
        if ($inspiration) {
            $this->levelPage = true;
            $this->inspirations[] = $inspiration->id;
            $this->inspirationNames[] = $inspiration->challenge->name;
        }
        if (isset($this->ideaId)) {
            $idea = Idea::find($this->ideaId);
            $this->body = $idea->body;
            $this->name = $idea->name;
            foreach ($idea->inspiration as $challengeVersion) {
                $this->inspirations[] = $challengeVersion->id;
                $this->inspirationNames[] = $challengeVersion->challenge->name;
            }
            foreach ($idea->users as $teammate) {
                if ($teammate->isNot($user)) {
                    $this->teammates[] = $teammate->id;
                    $this->teamNames[] = $teammate->full_name;
                }
            }
            $this->title = $this->name;
            $this->actionButtonText = __('Save');
        }
        else {
            $this->create = true;
            $this->title = __('Got an idea?');
            $this->actionButtonText = __('Start');
        }
        $this->studioMembers = $user->activeStudio->students->except($user->id);
        $this->challengeVersions = $user->activeStudio->challengeVersions;
        for ($i = 0; $i < count($this->studioMembers); $i++) {
            if (old("teammates.{$i}")) {
                $this->teammates[] = old("teammates.{$i}");
            }
        }
        $this->updatedTeammates($this->teammates);
    }

    public function render()
    {
        return view('livewire.student.idea-edit');
    }

    public function submit()
    {
        $validated = $this->validate();
        $user = Auth::user();
        $inspirations = [];
        $team = [$user->id];

        if (isset($this->ideaId)) {
            $idea = Idea::find($this->ideaId);
        }
        else {
            $idea = new Idea;
        }
        $idea->name = $validated['name'];
        $idea->body = $validated['body'];
        $idea->save();

        if ($idea->levels->count() == 0) {
            // TODO: there are less DB intensive ways to do this, but this will do.
            $level = new Level();
            $idea->levels()->save($level);
            $level->level_number = 1;
            $level->save();
            $level->start($user);
        }

        if (array_key_exists('inspirations', $validated)) {
            $challengeVersions = $user->activeStudio->challengeVersions;
            foreach ($validated['inspirations'] as $challengeVersionId) {
                if ($challengeVersions->contains($challengeVersionId)) {
                    $inspirations[] = $challengeVersionId;
                }
            }
        }
        $idea->inspiration()->sync($inspirations);

        if (array_key_exists('teammates', $validated)) {
            $students = $user->activeStudio->students;
            foreach ($validated['teammates'] as $teammate) {
                if ($students->contains($teammate)) {
                    $team[] = $teammate;
                }
            }
        }
        $idea->users()->sync($team);

        return redirect(route('student.idea', ['idea' => $idea]));
    }

    public function updatedInspirations($value)
    {
        $this->inspirationNames = [];
        foreach ($this->inspirations as $k => $challengeVersionId) {
            $this->inspirationNames[] = ChallengeVersion::find($challengeVersionId)->name;
        }
    }

    public function updatedTeammates($value)
    {
        $this->teamNames = [];
        foreach ($this->teammates as $k => $uid) {
            $this->teamNames[] = User::find($uid)->full_name;
        }
    }
}
