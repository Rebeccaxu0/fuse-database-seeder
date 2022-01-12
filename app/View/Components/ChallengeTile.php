<?php

namespace App\View\Components;

use App\Models\ChallengeVersion;
use Illuminate\View\Component;

class ChallengeTile extends Component
{
    /**
     * Challenge Version we're rendering.
     *
     * @var ChallengeVersion
     */
    public $challengeVersion;

    /**
     * Create a new component instance.
     *
     * @param ChallengeVersion $challengeVersion The ChallengeVersion to initialize.
     *
     * @return void
     */
    public function __construct(ChallengeVersion $challengeVersion)
    {
        $this->challengeVersion = $challengeVersion;
    }

    /**
     * Get the view / contents that represent the component.
     *
     * @return \Illuminate\Contracts\View\View|\Closure|string
     */
    public function render()
    {
        return view('components.challenge-tile');
    }
}
