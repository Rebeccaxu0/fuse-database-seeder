<?php

namespace App\Http\Livewire;

use App\Models\Artifact;
use App\Models\Idea;
use App\Models\Level;
use Carbon\Carbon;
use Livewire\Component;

class ArtifactModalTile extends Component
{
    public bool $showModalFlag = false;
    public Artifact $artifact;

    public function mount()
    {
        $this->parent = $this->artifact->artifactable;
        $this->timeAgo = Carbon::create($this->artifact->created_at)->diffForHumans();
        $this->comments = true;
        $this->commentCount = 0;
        if ($this->parent::class == Level::class) {
            $this->parent->type = 'level';
            $this->level = $this->parent;
            $this->title = $this->level->challengeVersion->challenge->name;
            $this->title_modifier = __('Level :number', ['number' => $this->level->level_number]);
        }
        else {
            $this->parent->type = 'idea';
            $this->title = $parent->name;
            $this->title_modifier = '';
        }
    }

    public function render()
    {
        return view('livewire.artifact-modal-tile');
    }
}

