<?php
 
namespace App\Http\Livewire;

use App\Models\User;
use Livewire\Component;
 
class UserSearchBar extends Component
{
    public $district;
    public $query;
    public $users;
    public $selectedusers =[];


    public function mount($district) {
        $this->district= $district;
    }

    public function addUsers()
    {
        foreach ($selectedusers as $user) {
            if (in_array($user->id)) {
              #$user->district()->dissociate(); can sf be in more
              $this->district->$user->associate();
            }
        }
        $this->reset();
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
