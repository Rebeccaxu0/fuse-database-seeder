<?php

namespace App\Http\Livewire;

use App\Models\Role;
use App\Models\User;
use Illuminate\Support\Facades\Auth;
use Livewire\Component;

class Impersonate extends Component
{
    public $search = '';
    public $searchResults = [];

    public function render()
    {
        $users_q = User::with(['activeStudio', 'activeStudio.school'])
            ->where(function ($query) {
            $query->where('name', 'like', "%{$this->search}%")
                ->orWhere('full_name', 'like', "%{$this->search}%")
                ->orWhere('email', 'like', "%{$this->search}%");
            })
            ->limit(10);

        // If we let facilitators or superfacilitators use this, we will limit
        // them to searching for member students of the active studio.
        if (! Auth::user()->is_admin()) {
          $users_q = $users_q->whereRelation('roles', 'id', Role::STUDENT_ID)
            ->whereRelation('studios', 'id', Auth::user()->activeStudio->id);
        }

        $this->users = $users_q->get();
        return view('livewire.impersonate');
    }
}
