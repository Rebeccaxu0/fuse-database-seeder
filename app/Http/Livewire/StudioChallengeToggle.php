<?php

namespace App\Http\Livewire;

use App\Http\Livewire\Toggle;
use App\Models\ChallengeVersion;
use App\Models\Studio;

class StudioChallengeToggle extends Toggle
{
    public bool $is_active = false;
    public string $event = 'toggle';
    public string $label = '';
    public int $studioId;
    public int $challengeVersionId;

    public function mount() {
        $studio = Studio::find($this->studioId);
        $challengeVersion = ChallengeVersion::find($this->challengeVersionId);
        $this->is_active = $studio->challengeVersions->contains($challengeVersion);
    }

    public function toggle()
    {
        parent::toggle();
        $action = $this->is_active ? 'attach' : 'detach';
        $studio = Studio::find($this->studioId);
        $studio->challengeVersions()->$action($this->challengeVersionId);
    }
}

