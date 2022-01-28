<?php

namespace App\Http\Livewire;

use Illuminate\Support\Facades\Auth;
use App\Http\Livewire\Toggle;

class StudioChallengeToggle extends Toggle
{
    public $challengeVersion;
    public $is_active;

    public function mount() {
        $this->is_active = Auth::user()
             ->activeStudio
             ->challengeVersions
             ->contains($this->challengeVersion);
    }

    public function toggle()
    {
      $studio = Auth::user()->activeStudio;
      if ($this->is_active) {
          $studio->challengeVersions()->detach($this->challengeVersion->id);
      }
      else {
          $studio->challengeVersions()->attach($this->challengeVersion->id);
      }

      parent::toggle();
    }

}
