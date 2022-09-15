<?php

namespace App\Http\Livewire;

use App\Models\User;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Support\Facades\Auth;
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
        $user = Auth::user();
        $users = User::where('status', 1);
        $users = $users->where(function ($query) {
            $query->orWhere('name', 'like', "%{$this->query}%")
            ->orWhere('full_name', 'like', "%{$this->query}%")
            ->orWhere('email', 'like', "%{$this->query}%");
        });
        if (! $user->isAdmin() && $user->isSuperFacilitator()) {
            $district = $user->activeStudio->school->district;
            $users = $users->where(function ($outerQuery) use ($district) {
                $outerQuery
                    ->orWhereHas('districts', function (Builder $innerQuery) use ($district) {
                        $innerQuery->where('id', $district->id);
                    })
                    ->orWhereHas('schools', function (Builder $innerQuery) use ($district) {
                        $innerQuery->whereIn('id', $district->schools->pluck('id'));
                    })
                    ->orWhereHas('studios', function (Builder $innerQuery) use ($district) {
                        $innerQuery->whereIn('id', $district->studios->pluck('id'));
                    });
            });
        }
        $this->users = $users
            ->orderBy('name', 'asc')
            ->orderBy('full_name', 'asc')
            ->orderBy('email', 'asc')
            ->limit(15)
            ->get();
    }

    public function render()
    {
        return view('livewire.user-search-bar');
    }
}
