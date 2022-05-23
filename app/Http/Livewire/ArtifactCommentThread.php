<?php

namespace App\Http\Livewire;

use App\Models\Artifact;
use App\Models\Comment;
use App\Models\User;
use Illuminate\Support\Facades\DB;
use Livewire\Component;

class ArtifactCommentThread extends Component
{
    public User $user;
    public Artifact $artifact;
    public string $newComment = '';

    protected $listeners = ['markCommentsAsSeen'];

    public function mount()
    {
        $this->comments = $this->artifact->comments;
    }

    public function markCommentsAsSeen(int $artifactId)
    {
        if ($this->artifact->id == $artifactId) {
            $markAsSeen = [];
            foreach ($this->comments as $comment) {
                if (! in_array($this->user->id, $comment->seenBy->pluck('id')->all())) {
                    $markAsSeen[] = [
                        'user_id' => $this->user->id,
                        'comment_id' => $comment->id,
                    ];
                }
            }
            if (! empty($markAsSeen)) {
                DB::table('comment_seen')->insert($markAsSeen);
            }
        }
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
