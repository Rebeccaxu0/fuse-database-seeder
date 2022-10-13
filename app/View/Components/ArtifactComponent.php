<?php

namespace App\View\Components;

use App\Models\Artifact;
use App\Models\ChallengeVersion;
use App\Models\Idea;
use App\Models\Studio;
use Carbon\Carbon;
use Illuminate\Support\Arr;
// use Illuminate\Support\Collection;
use Illuminate\View\Component;
// use MediaUploader;

class ArtifactComponent extends Component
{
    public Artifact $artifact;
    public ?Studio $studio;
    public ?Idea $idea = null;
    // public Collection $related;
    public ?string $downloadUrl = null;
    public string $inspiration = '';
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
        $this->downloadUrl = $artifact->getDownloadUrl();
        foreach ($artifact->users as $teammate) {
            if ($teammate->full_name) {
                $teammates[] = $teammate->full_name;
            }
            else {
                $teammates[] = $teammate->name;
            }
            $this->teamnames = Arr::join($teammates, ', ', ' and ');
        }
        // TODO: refactor related artifacts to better query. This adds a ton of overhead.
        // $this->related = Auth::user()
        //      ->artifacts()
        //      ->with(['level', 'level.levelable', 'media'])
        //      ->where('level_id', $artifact->level->id)
        //      ->get()
        //      ->except([$artifact->id]);
        if ($this->artifact->level && $this->artifact->level->levelable) {
            if ($this->artifact->level->levelable::class == ChallengeVersion::class) {
                $this->artifact->level->type = 'level';
                $this->level = $this->artifact->level;
                $this->title = $this->level->levelable->challenge->name;
                $this->title_modifier = __('L:number', ['number' => $this->level->level_number]);
                $this->levelRoute = route('student.level', [$this->level->levelable, $this->level]);
            } else {
                $this->artifact->level->type = 'idea';
                $this->idea = $this->artifact->level->levelable;
                $this->inspiration = $this->idea->inspirationListToStr();
                $this->title = $this->idea->name;
                $this->title_modifier = __('Idea');
                $this->levelRoute = route('student.idea', $this->idea);
            }
        }
        else {
            $this->artifact->level->type = 'orphan';
            $this->title = 'Orphan DJ ' . $this->artifact->id;
            $this->title_modifier = '';
            $this->levelRoute = '';
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

