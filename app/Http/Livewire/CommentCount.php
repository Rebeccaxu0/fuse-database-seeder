<?php

namespace App\Http\Livewire;

use App\Models\Artifact;
use Livewire\Component;

class CommentCount extends Component
{
    public Artifact $artifact;
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
    }

    public function render()
    {
        return view('livewire.comment-count');
    }
}
