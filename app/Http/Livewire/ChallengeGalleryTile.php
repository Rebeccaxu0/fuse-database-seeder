<?php

namespace App\Http\Livewire;

use App\Models\ChallengeVersion;
use App\Models\User;
use Livewire\Component;

class ChallengeGalleryTile extends Component
{
    public bool $showModalFlag = false;
    public ChallengeVersion $challengeVersion;
    public User $user;

    public function mount(ChallengeVersion $challengeVersion, User $user = null)
    {
        $this->challengeVersion = $challengeVersion;
        $this->user = ! is_null($user) ? $user : Auth::user();
    }

    public function render()
    {
        return view('livewire.challenge-gallery-tile');
    }
}
