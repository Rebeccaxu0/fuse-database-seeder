<?php

namespace App\Http\Livewire;

use App\Models\User;
use Livewire\Component;

class AddSuperFacilitator extends Component
{
    public $selectedusers = [];

    protected $listeners = ['userSelected' => 'addUser'];

    public function addUser(User $user)
    {
        $this->selectedusers[$user->id] = ['name' => $user->name, 'full_name' => $user->full_name];
    }

    public function removeUser($id)
    {
        unset($this->selectedusers[$id]);
    }

    public function render()
    {
        return view('livewire.add-super-facilitator');
    }
}
