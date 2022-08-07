<?php

namespace App\Http\Livewire\Student;

use App\Models\Artifact;
use App\Models\ChallengeVersion;
use App\Models\Idea;
use App\Models\Studio;
use Carbon\Carbon;
use Livewire\Component;

class ActivityArtifact extends Component
{
    public bool $showModalFlag = false;
    public Artifact $artifact;
    public Studio $studio;
    public string $timeAgo;
    public string $title = '';
    public string $title_modifier = '';

    public function mount()
    {
        $this->timeAgo = Carbon::create($this->artifact->created_at)->diffForHumans();
        $this->title = 'Orphan DJ ' . $this->artifact->id;
        $this->title_modifier = '';
        if ($this->artifact && $this->artifact->level && ! is_null($this->artifact->level->levelable)) {
            if ($this->artifact->level->levelable::class == ChallengeVersion::class) {
                $this->title = $this->artifact->level->levelable->challenge->name;
                $this->title_modifier = __('Level :number', ['number' => $this->artifact->level->level_number]);
            } else if ($this->artifact->level->levelable::class == Idea::class) {
                $this->title = $this->artifact->level->levelable->name;
            }
        }
    }


    public function render()
    {
        return view('livewire.student.activity-artifact');
    }
}
