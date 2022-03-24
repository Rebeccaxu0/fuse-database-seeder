<?php

namespace App\View\Components\Student;

use App\Models\Start;
use Carbon\Carbon;
use Illuminate\View\Component;

class ActivityFeedStart extends Component
{
    public Start $start;
    public string $name;
    public string $timeAgo;

    /**
     * Create a new component instance.
     *
     * @return void
     */
    public function __construct(Start $start)
    {
        $this->start = $start;
        $this->name = $start->user->firstName() . ' ' . $start->user->abbreviatedLastName();
        $this->timeAgo = Carbon::create($start->created_at)->diffForHumans();
    }

    /**
     * Get the view / contents that represent the component.
     *
     * @return \Illuminate\Contracts\View\View|\Closure|string
     */
    public function render()
    {
        return view('student.activity-feed-start');
    }
}
