<?php

namespace App\View\Components;

use App\Models\Idea;
use App\Models\Level;
use App\Models\User;
use Illuminate\View\Component;

class DashboardStatus extends Component
{
    public User $user;
    public string $buttonLink;
    public string $buttonText;

    /**
     * Create a new component instance.
     *
     * @return void
     */
    public function __construct(User $user)
    {
        // Action button should link to the Challenge Gallery when:
        //   - It's a new user with no activity
        //     *OR*
        //   - The user's most recent activity is an Artifact of type 'complete'
        //     for the last level in the ChallengeVersion or Idea level sequence
        //
        // Action button should link to the *NEXT* level in sequence when:
        //   - The user's most recent activity is an Artifact of type
        //     'complete' for a non-final level.
        //
        // Action button should link to $user->current_level when that level when:
        //   - that level is uncompleted.
        //
        // In the second two scenarios, the level must belong to a ChallengeVersion
        // that is currently active in the user's active studio.
        //
        // Examples:
        //   - New user --> challenge gallery
        //
        //   - $user->current_level is uncompleted and in an active
        //     challengeversion or any Idea
        //     --> current_level
        //
        //   - $user->current_level belongs to an inactive challengeversion
        //     --> Find most recent start/save/complete for any Idea or
        //         challengeVersion that is active in this studio and use above

        $this->user = $user->load('starts');

        // `Current Level` and `Previous Level` should be empty only for new users
        if (is_null($this->user->current_level) && is_null($this->user->previous_level)) {
            $this->explore();
            return;
        }

        // A user can always continue working on their own Ideas
        if ($this->user->current_level->parent::type === Idea::type) {
            $this->continue($this->user->current_level);
            return;
        }

        // A user can always continue working on active Challenges.
        $activeLevels
            = $this->user->activeStudio->activeChallenges
               ->map(fn($challengeVersion, $key) => $challengeVersion->levels)
               ->flatten()
               ->pluck('id');
        if ($activeLevels->contains($this->user->current_level->id)
            && ! $user->hasCompletedLevel($this->user->current_level)) {
            $this->buttonText = __('Continue current level');
            $this->buttonLink = route('student.challenges');
        }

        $ideaStarts = $this->user->ideaStarts->sortDesc();
        $levelStarts = $this->user->levelStarts->whereIn('startable_id', $activeLevels)->sortDesc();

        $latestStart = null;
        if (! empty($ideaStarts) || ! empty($levelStarts)) {
            if (empty($ideaStarts)) {
                $latestStart = $levelStart->first();
            }
            else if (empty($levelStarts)) {
                $latestStart = $ideaStart->first();
            }
            else {
                $latestStart
                    = $ideaStarts->first()->created_at > $levelStarts->first()->created_at
                    ? $ideaStarts->first()
                    : $levelStarts->first();
            }
        }
        // If no levels started or last level of challenge is complete:
        if (is_null($latestStart) || (
            ! empty($levelStarts)
            && $user->hasCompletedChallengeVersion($levelStarts->first()->startable->challengeVersion))) {
            $this->buttonText = __('Explore challenges');
            $this->buttonLink = route('student.challenges');
        }
        else if ($user->hasCompletedLevel($latestStart->startable)) {
            // If most recently started idea/level is complete:
            $this->buttonText = __('Start next level');
            $this->buttonLink = route('student.challenges');
        }
        else {
            // If most recently started idea/level is not completed:
        }

    }

    /**
     * Get the view / contents that represent the component.
     *
     * @return \Illuminate\Contracts\View\View|\Closure|string
     */
    public function render()
    {
        return view('components.dashboard-status');
    }

    private function explore()
    {
        $this->buttonText = __('Explore challenges');
        $this->buttonLink = route('student.challenges');
    }

    private function continue(Level $level)
    {
        if ($level->levelable::class === Idea::class) {
            $this->buttonText = __('Continue working on your Idea');
        }
        else {
            $this->buttonText = __('Continue current level');
        }
        $this->buttonLink = route('student.challenges');
    }

    private function next(Level $level)
    {
        $this->buttonText = __('Start the next level');
        $this->buttonLink = route('student.challenges');
    }
}
