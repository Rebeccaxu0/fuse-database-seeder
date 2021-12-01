<?php

namespace App\View\Components;

use App\Models\ChallengeVersion;
use Illuminate\View\Component;

class ChallengeTile extends Component
{
    /**
     * Challenge Version we're rendering.
     * @var ChallengeVersion
     */
    public $challenge;

    /**
     * Create a new component instance.
     *
     * @return void
     */
    public function __construct(ChallengeVersion $challenge)
    {
        $this->challenge = $challenge;
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
