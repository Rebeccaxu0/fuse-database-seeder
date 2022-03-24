<?php

namespace App\Http\Livewire;

use App\Models\Artifact;
use App\Models\Level;
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
        if ($this->artifact->artifactable::class == Level::class) {
            $this->title = $this->artifact->artifactable->challengeVersion->challenge->name;
            $this->title_modifier = __('Level :number', ['number' => $this->artifact->artifactable->level_number]);
        }
        else {
            $this->title = $this->artifact->artifactable->name;
        }
    }

    public function render()
    {
        return view('livewire.artifact-modal-tile');
    }
}

