<?php

namespace App\View\Components;

use App\Models\ChallengeVersion;
use App\Models\Start;
use App\Models\Studio;
use App\Models\User;
use Illuminate\Support\Collection;
use Illuminate\View\Component;

class HelpFinderTilePane extends Component
{
    /**
     * Challenge Version we're rendering.
     * @var ChallengeVersion
     */
    public ChallengeVersion $challengeVersion;

    /**
     * Studio from which to determine activity.
     */
    public Studio $studio;

    public Collection $students;
    public array $completedLevel = [];

    /**
     * Create a new component instance.
     *
     * @return void
     */
    public function __construct(ChallengeVersion $challengeVersion, Studio $studio)
    {
        // For each student, get the highest completed level and the highest
        // started level, and use the level number.

        $this->challengeVersion = $challengeVersion;
        $this->studio = $studio;
        $starts = Start::whereIn('user_id', $studio->students->pluck('id'))
            ->whereIn('level_id', $challengeVersion->levels->pluck('id'))
            ->get();
        $this->students
            = User::whereHas('starts', function ($query) use ($starts) {
                return $query->whereIn('id', $starts->pluck('id'));
            })
                ->get();
        foreach ($this->students as $student) {
            $hcl = $challengeVersion->highestCompletedLevel($student);
            $student->highestCompletedLevel =
            $this->completedLevel[$student->id] = $hcl ? $hcl->level_number : null;
        }
        $this->students = $this->students->sortByDesc([
            fn($a, $b) => $b->isOnline() <=> $a->isOnline(),
            ['highestCompletedLevel', 'desc'],
        ]);
    }

    /**
     * Get the view / contents that represent the component.
     *
     * @return \Illuminate\Contracts\View\View|\Closure|string
     */
    public function render()
    {
        return view('components.help-finder-tile-pane');
    }
}
