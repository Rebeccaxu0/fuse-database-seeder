<?php

namespace App\View\Components;

use App\Models\ChallengeVersion;
use App\Models\User;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\View\Component;

class ProgressBar extends Component
{
    public bool $interactive = true;
    public ChallengeVersion $challengeVersion;
    public Collection $levels;

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
        $this->challengeVersion = $challengeVersion->load('levels');
        $this->levels = $this->challengeVersion->levels->sortBy('level_number');
        foreach ($this->levels as $level) {
          if ($user->completedLevel($level)) {
              $level->status = 'completed';
          }
          else if ($user->startedLevel($level)) {
              $level->status = 'started';
          }
          else {
              $level->status = 'unstarted';
          }
        }
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
