<?php

namespace App\Http\Livewire;

use App\Models\User;
use Illuminate\Database\Eloquent\Collection;
use Livewire\Component;

class UserSearchBar extends Component
{
    public string $query = '';
    public Collection $users;

    public function selectUser($id)
    {
        $this->emitUp('userSelected', $id);
        $this->query = '';
    }

    public function updatedQuery()
    {
        $user = auth()->user();
        if ($user->isAdmin()) {
        $this->users = User::where('name', 'like', "%{$this->query}%")
            ->orWhere('full_name', 'like', "%{$this->query}%")
            ->orWhere('email', 'like', "%{$this->query}%")
            ->orderBy('name', 'asc')
            ->orderBy('full_name', 'asc')
            ->orderBy('email', 'asc')
            ->limit(15)
            ->get();
        }
        else {
            if ($user->isSuperFacilitator()) {
                $district = $user->activeStudio->school->district;
                $this->users = $district->students()->get();
                // ->limit(15);
            }
        }
    }

    public function render()
    {
        return view('livewire.user-search-bar');
    }
}
