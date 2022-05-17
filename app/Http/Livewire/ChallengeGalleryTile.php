<?php

namespace App\Http\Livewire;

use App\Models\ChallengeVersion;
use App\Models\User;
use Livewire\Component;

class ChallengeGalleryTile extends Component
{
    public bool $showModalFlag = false;
    public bool $continue = false;
    public ChallengeVersion $challengeVersion;
    public User $user;

    public function mount(ChallengeVersion $challengeVersion, User $user)
    {
        $this->challengeVersion = $challengeVersion;
        $this->user = $user;
        // Always show the trailer, BUT below the the trailer display content
        // based on current level of the challenge version.
        $this->level = $challengeVersion->currentLevel($user);
        if ($user->hasStartedLevel($this->level)){
            $this->continue = true;
        }
    }

    public function render()
    {
        return view('livewire.challenge-gallery-tile');
    }
}
