<?php
 
namespace App\Http\Livewire;

use App\Models\User;
use Livewire\Component;
 
class UserSearchBar extends Component
{
    public $district;

    public $query;
    public $users;
    public $selected;


    public function mount($district) {
        $this->district= $district;
    }

    public function selectUser()
    {
        $user = $this->users[$this->selected] ?? null;
        $district = $this->district;
        if ($user) {
            $user->$district->associate();
            $user->save();
        }
        $this->reset();
    }
 
    public function updatedQuery()
    {
        $this->users = \App\Models\User::where('name', 'like', '%' . $this->query . '%')
                                        ->whereHas('roles', function($q){
                                                        $q->where('name', 'Facilitator'); //super facilitator for district?
                                                    })
            ->get()
            ->toArray();
    }
 
    public function render()
    {
        return view('livewire.user-search-bar');
    }
}
