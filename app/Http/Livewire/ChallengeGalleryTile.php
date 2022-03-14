<?php

namespace App\Http\Livewire;

use App\Models\ChallengeVersion;
use App\Models\User;
use Illuminate\Support\Facades\Auth;
use Livewire\Component;

class ChallengeGalleryTile extends Component
{
    public bool $showModalFlag = false;
    public ChallengeVersion $challengeVersion;
    public User $user;

    public function mount(ChallengeVersion $challengeVersion, User $user)
    {
        $this->challengeVersion = $challengeVersion;
        $this->user = $user;
    }

    public function render()
    {
        return view('livewire.challenge-gallery-tile');
    }
}
