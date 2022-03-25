<?php

namespace App\View\Components\Student;

use App\Models\Artifact;
use App\Models\Start;
use App\Models\Studio;
use Carbon\Carbon;
use Illuminate\View\Component;

class ActivityFeedCard extends Component
{
    public Artifact|Start $activity;
    public Studio $studio;
    public string $name = '';
    public string $timeAgo;

    /**
     * Create a new component instance.
     *
     * @return void
     */
    public function __construct(Artifact|Start $activity, Studio $studio)
    {
        $this->activity = $activity;
        $this->studio = $studio;
        $this->timeAgo = Carbon::create($activity->created_at)->diffForHumans();
    }

    /**
     * Get the view / contents that represent the component.
     *
     * @return \Illuminate\Contracts\View\View|\Closure|string
     */
    public function render()
    {
      return $this->activity::class === Start::class
        ? view('student.activity-feed.start')
        : view('student.activity-feed.artifact');
    }
}
