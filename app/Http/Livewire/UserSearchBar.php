<?php
 
namespace App\Http\Livewire;

use App\Models\User;
use Livewire\Component;
 
class UserSearchBar extends Component
{
    public $district;
    public $query;
    public $users;
    public $selectedusers = [];


    public function mount($district, $selectedusers) {
        $this->district= $district;
        $this->selectedusers = $selectedusers;
    }

    public function addUsers()
    {
        foreach ($this->selectedusers as $user) {
            if (in_array($user->id)) {
              #$user->district()->dissociate(); can sf be in more
              $district->$user->attach();
            }
        }
    }
 
    public function updatedQuery()
    {
        $this->users = \App\Models\User::where('name', 'like', '%' . $this->query . '%')
                                        ->whereHas('roles', function($q){
                                                        $q->where('name', 'Super Facilitator'); //super facilitator for district?
                                                    })
                                                    #->where(->districts()->id, '!=', $this->district->id)
            ->get();
    }
 
    public function render()
    {
        sleep(1);
        return view('livewire.user-search-bar');
    }
}
