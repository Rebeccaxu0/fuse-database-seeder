<?php

namespace App\Http\Livewire;

use App\Models\Artifact;
use App\Models\User;
use Livewire\Component;

class CommentCount extends Component
{
    public Artifact $artifact;
    public User $user;
    public bool $unseen = false;
    public int $commentCount = 0;

    protected $listeners = ['newComment'];

    public function newComment(int $artifactId)
    {
        if ($artifactId == $this->artifact->id) {
            $this->artifact->fresh();
            $this->commentCount = $this->artifact->comments->count();
        }
    }

    public function mount()
    {
        $this->commentCount = $this->artifact->comments->count();
        foreach ($this->artifact->comments as $comment) {
            if (! in_array($this->user->id, $comment->seenBy->pluck('id')->all())) {
                $this->unseen = true;
                break;
            }
        }
    }

    public function render()
    {
        return view('livewire.comment-count');
    }
}
