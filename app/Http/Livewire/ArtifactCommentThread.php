<?php

namespace App\Http\Livewire;

use App\Models\Artifact;
use App\Models\Comment;
use App\Models\User;
use Livewire\Component;

class ArtifactCommentThread extends Component
{
    public User $user;
    public Artifact $artifact;
    public string $newComment = '';

    public function mount()
    {
        $this->comments = $this->artifact->comments;
    }

    public function submit()
    {
        $comment = new Comment([
            'artifact_id' => $this->artifact->id,
            'body' => $this->newComment,
            'user_id' => $this->user->id,
        ]);
        $comment->save();
        $this->comments = Comment::where('artifact_id', $this->artifact->id)->get();
        $this->newComment = '';
        $this->emit('newComment', $this->artifact->id);
    }

    public function render()
    {
        return view('livewire.artifact-comment-thread');
    }
}
