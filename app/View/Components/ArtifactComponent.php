<?php

namespace App\View\Components;

use App\Models\Artifact;
use App\Models\Level;
use App\Models\Studio;
use Carbon\Carbon;
use Illuminate\View\Component;

class ArtifactComponent extends Component
{
    public Artifact $artifact;
    public Studio $studio;
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
    public function __construct(Artifact $artifact, Studio $studio)
    {
        $this->artifact = $artifact;
        $this->studio = $studio;
        $this->timeAgo = Carbon::create($artifact->created_at)->diffForHumans();
        $this->comments = (bool) $studio->allow_comments;
        $this->commentCount = 0;
        if ($this->artifact->artifactable::class == Level::class) {
            $this->artifact->artifactable->type = 'level';
            $this->level = $this->artifact->artifactable;
            $this->title = $this->level->challengeVersion->challenge->name;
            $this->title_modifier = __('Level :number', ['number' => $this->level->level_number]);
        }
        else {
            $this->artifact->artifactable->type = 'idea';
            $this->idea = $this->artifact->artifactable;
            $this->title = $parent->name;
            $this->title_modifier = '';
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

