<?php

namespace App\Http\Livewire;

use App\Models\Artifact;
use App\Models\ChallengeVersion;
use App\Models\Studio;
use Livewire\Component;

class ArtifactModalTile extends Component
{
    public bool $showModalFlag = false;
    public Artifact $artifact;
    public Studio $studio;
    public string $title = '';
    public string $title_modifier = '';

    public function mount()
    {
        if ($this->artifact->level->levelable::class == ChallengeVersion::class) {
            $this->title = $this->artifact->level->levelable->challenge->name;
            $this->title_modifier = __('Level :number', ['number' => $this->artifact->level->level_number]);
        }
        else {
            $this->title = $this->artifact->level->levelable->name;
        }
    }

    public function render()
    {
        return view('livewire.artifact-modal-tile');
    }
}

