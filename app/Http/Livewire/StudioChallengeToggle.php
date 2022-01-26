<?php

namespace App\Http\Livewire;

use App\Model\ChallengeVersion;
use Illuminate\Support\Facades\Auth;
use Livewire\Component;

class StudioChallengeToggle extends Component
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

      $this->is_active = ! $this->is_active;
    }

    public function render()
    {
        return view('livewire.studio-challenge-toggle');
    }
}
