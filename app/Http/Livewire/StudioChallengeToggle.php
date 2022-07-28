<?php

namespace App\Http\Livewire;

use App\Http\Livewire\Toggle;
use App\Models\ChallengeVersion;
use App\Models\Studio;
use Illuminate\Support\Facades\Cache;

class StudioChallengeToggle extends Toggle
{
    public Studio $studio;
    public ChallengeVersion $challengeVersion;

    public function mount() {
        $this->is_active = (bool) $this->studio->challengeVersions->contains($this->challengeVersion);
    }

    public function toggle()
    {
        parent::toggle();

        $action = $this->is_active ? 'attach' : 'detach';
        $this->studio->challengeVersions()->$action($this->challengeVersion->id);
        Cache::tags(['packages'])->forget("studio_{$this->studio->id}_active_challenges");
    }
}
