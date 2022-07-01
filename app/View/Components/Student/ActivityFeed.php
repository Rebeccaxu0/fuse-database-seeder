<?php

namespace App\View\Components\Student;

use App\Models\Artifact;
use App\Models\Start;
use App\Models\Studio;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\View\Component;

class ActivityFeed extends Component
{
    public $studentActivity;
    public Studio $studio;

    /**
     * Create a new component instance.
     *
     * @return void
     */
    public function __construct(Studio $studio)
    {
        $this->studio = $studio;
        // We want a Collection of Starts, Saves, and Completes sorted by
        // creation date for the students in the studio. Ideally this would be
        // a single query, but I don't think we can do that without sidestepping
        // the Eloquent ORM.
        // The naive approach is below:
        //   - Get a user list
        //   - Get starts for those users
        //   - Get Artifacts for those users
        //   - Merge the Collections, sort by date and paginate
        // This introduces the complication of paginating due to merging.
        $limit = 10;
        $students = $studio->students->pluck('id');
        $starts = Start::whereIn('user_id', $students)
            ->orderBy('created_at', 'desc')
            ->limit($limit)
            ->get();
        $eager = [
            'users',
            'comments',
            'level',
            'level.levelable',
            // 'level.levelable.challenge',
        ];
        $artifacts = Artifact::with($eager)
            ->whereHas('users', function (Builder $query) use ($students) {
                $query->whereIn('user_id', $students);
            })
            ->orderBy('created_at', 'desc')
            ->limit($limit)
            ->get();
        $this->studentActivity = $artifacts
             ->merge($starts)
             ->sortByDesc('created_at');
             // ->paginate(10);
    }

    /**
     * Get the view / contents that represent the component.
     *
     * @return \Illuminate\Contracts\View\View|\Closure|string
     */
    public function render()
    {
        return view('student.activity-feed.index');
    }
}
