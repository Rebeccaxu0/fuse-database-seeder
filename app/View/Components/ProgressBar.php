<?php

namespace App\View\Components;

use App\Models\ChallengeVersion;
use App\Models\User;
use Illuminate\View\Component;

class ProgressBar extends Component
{
    public bool $interactive = true;
    public ChallengeVersion $challengeVersion;

    /**
     * User
     *
     * @var User
     */
    public User $user;

    /**
     * Create a new component instance.
     *
     * @param ChallengeVersion $challenge_version Challenge Version
     *
     * @return void
     */
    public function __construct(ChallengeVersion $challengeVersion, User $user, bool $interactive = true)
    {
        $this->interactive = $interactive;
        $this->challengeVersion = $challengeVersion;
        $this->user = $user;
    }

    /**
     * Get the view / contents that represent the component.
     *
     * @return \Illuminate\Contracts\View\View|\Closure|string
     */
    public function render()
    {
        return view('components.progress-bar');
    }
}
