<?php

namespace App\View\Components;

use App\Models\Idea;
use App\Models\Level;
use App\Models\User;
use Illuminate\View\Component;

class DashboardStatus extends Component
{
    public bool $explore = false;
    public string $mostRecent = '';
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
        //     for the last level in the ChallengeVersion level sequence
        //
        // Action button should link to the *NEXT* level in sequence when:
        //   - The user's most recent activity is an Artifact of type
        //     'complete' for a non-final level.
        //
        // Action button should link to $user->currentLevel when that level when:
        //   - that level is uncompleted.
        //
        // In the second two scenarios, the level must belong to a ChallengeVersion
        // that is currently active in the user's active studio.
        //
        // Examples:
        //   - New user --> challenge gallery
        //
        //   - $user->currentLevel is uncompleted and in an active
        //     challengeversion or any Idea
        //     --> currentLevel
        //
        //   - $user->currentLevel belongs to an inactive challengeversion
        //     --> Find most recent start/save/complete for any Idea or
        //         challengeVersion that is active in this studio and use above

        // If the user has started any level...
        if ($user->currentLevel) {
            $level = $user->currentLevel;
            // If the Current Level is completed...
            if ($level->isCompleted($user)) {
                // If there is a startable next level, allow the user to start/continue it.
                if ($level->next() && $level->next()->isStartable($user)) {
                    $this->start($level->next(), $user);
                }
                // If there's no next level, or the next level is unstartable
                // go to Challenge Gallery.
                else {
                    $this->explore();
                }
            }
            else if ($level->isStartable($user)) {
                $this->continue($level);
            }
            else {
                $this->explore();
            }
        }
        else {
            $this->explore();
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
        $this->explore = true;
        $this->buttonText = __('Explore challenges');
        $this->buttonLink = route('student.challenges');
    }

    private function continue(Level $level)
    {
        if ($level->levelable::class === Idea::class) {
            $this->mostRecent = $level->levelable->name;
            $this->buttonText = __('Continue working on your Idea');
            $this->buttonLink = route('student.idea', [$level->levelable]);
        }
        else {
            $this->mostRecent = __(':challenge Level :number', [
                'challenge' => $level->levelable->challenge->name,
                'number' => $level->level_number,
            ]);
            $this->buttonText = __('Continue');
            $this->buttonLink = route('student.level', [$level->levelable, $level]);
        }
    }

    private function start(Level $level, User $user)
    {
        $this->mostRecent = __(':challenge Level :number', [
            'challenge' => $level->levelable->challenge->name,
            'number' => $level->level_number,
        ]);
        $this->buttonText = __('Start next level');
        if ($user->hasStartedLevel($level)) {
            // If previously started, just link to the level.
            $this->buttonLink = route('student.level', [$level->levelable, $level]);
        }
        else {
            // TODO: turn this into a proper start form.
            $this->buttonLink = route('student.level', [$level->levelable, $level]);
        }
    }
}
