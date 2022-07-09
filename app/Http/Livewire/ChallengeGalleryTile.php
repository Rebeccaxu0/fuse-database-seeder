<?php

namespace App\Http\Livewire;

use App\Models\ChallengeVersion;
use App\Models\User;
use Illuminate\Support\Facades\Http;
use Livewire\Component;

class ChallengeGalleryTile extends Component
{
    public bool $showModalFlag = false;
    public bool $continue = false;
    public ChallengeVersion $challengeVersion;
    public User $user;

    public function mount(ChallengeVersion $challengeVersion, User $user)
    {
        if (! $challengeVersion->gallery_thumbnail_url) {
            $wistia = Http::get('http://fast.wistia.net/oembed?url=http://home.wistia.com/medias/' . $challengeVersion->gallery_wistia_video_id);
            $challengeVersion->gallery_thumbnail_url = $wistia->json('thumbnail_url');
            $challengeVersion->save();
        }
        $this->user = $user;
        $this->challengeVersion = $challengeVersion;
        // Always show the trailer, BUT below the the trailer display content
        // based on current level of the challenge version.
        $this->level = $challengeVersion->currentLevel($user);
        if (! $this->level) {
            $this->level = $challengeVersion->levels->first();
        }
        if ($this->level && $user->hasStartedLevel($this->level)) {
            $this->continue = true;
        }
    }

    public function render()
    {
        return view('livewire.challenge-gallery-tile');
    }
}
