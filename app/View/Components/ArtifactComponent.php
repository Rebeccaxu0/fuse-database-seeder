<?php

namespace App\View\Components;

use App\Models\Artifact;
use App\Models\ChallengeVersion;
use App\Models\Idea;
use App\Models\Studio;
use Carbon\Carbon;
use Illuminate\Support\Arr;
use Illuminate\Support\Collection;
use Illuminate\Support\Facades\Auth;
use Illuminate\View\Component;

class ArtifactComponent extends Component
{
    public Artifact $artifact;
    public ?Studio $studio;
    public ?Idea $idea = null;
    public Collection $related;
    public string $inspiration;
    public string $levelRoute;
    public string $teamnames;
    public string $title;
    public string $title_modifier;
    public string $timeAgo;
    public bool $comments;
    public int $commentCount;

    /**
     * Create a new component instance.
     *
     * @return void
     */
    public function __construct(Artifact $artifact, ?Studio $studio)
    {
        $this->artifact = $artifact;
        $this->studio = $studio;
        $this->timeAgo = Carbon::create($artifact->created_at)->diffForHumans();
        $this->comments = (bool) ($studio) ? $studio->allow_comments : false;
        $this->commentCount = $artifact->comments->count();
        $this->teamnames = Arr::join($artifact->users->pluck('full_name')->all(), ', ', ' and ');
        $this->related = Auth::user()->artifacts->except([$artifact->id])->where('level_id', $artifact->level->id);
        $this->inspiration = __('none');
        if ($this->artifact->level->levelable::class == ChallengeVersion::class) {
            $this->artifact->level->type = 'level';
            $this->level = $this->artifact->level;
            $this->title = $this->level->levelable->challenge->name;
            $this->title_modifier = __('Level :number', ['number' => $this->level->level_number]);
            $this->levelRoute = route('student.level', [$this->level->levelable, $this->level]);
        }
        else {
            $this->artifact->level->type = 'idea';
            $this->idea = $this->artifact->level->levelable;
            $inspiration = $this->idea->inspirationListToStr();
            $this->title = $this->idea->name;
            $this->title_modifier = __('Idea');
            $this->levelRoute = route('student.idea', $this->idea);
        }
    }

    /**
     * Get the view / contents that represent the component.
     *
     * @return \Illuminate\Contracts\View\View|\Closure|string
     */
    public function render()
    {
        return view('components.artifact');
    }
}

