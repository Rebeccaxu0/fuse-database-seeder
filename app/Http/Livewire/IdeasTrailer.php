<?php

namespace App\Http\Livewire;

use App\Models\User;
use Illuminate\Support\Facades\Auth;
use Livewire\Component;

class IdeasTrailer extends Component
{
    public bool $showModalFlag = false;
    public User $user;

    public function mount()
    {
        $this->user = Auth::user();
        $this->showModalFlag = ! $this->user->seen_idea_trailer;
    }

    public function updatedShowModalFlag($value)
    {
        if ($value == false && $this->user->seen_idea_trailer == false) {
            $this->user->seen_idea_trailer = true;
            $this->user->save();
        }
    }

    public function render()
    {
        return view('livewire.ideas-trailer');
    }
}
