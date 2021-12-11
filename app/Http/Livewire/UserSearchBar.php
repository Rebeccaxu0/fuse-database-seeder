<?php

namespace App\Http\Livewire;

use App\Models\User;
use Livewire\Component;

class UserSearchBar extends Component
{
    public $district;
    public $query;
    public $selectedusers = [];


    public function mount($district) {
        $this->district = $district;
    }

    public function addUser($id)
    {
      $user = User::find($id);
      $this->selectedusers[$id] = ['name' => $user->name, 'full_name' => $user->full_name];
      $this->query = '';
    }

    public function removeUser($id)
    {
      unset($this->selectedusers[$id]);
    }

    public function updatedQuery()
    {
      $this->users = User::where('name', 'like', "%{$this->query}%")
        ->limit(10)
        ->get();
    }

    public function render()
    {
        return view('livewire.user-search-bar');
    }
}
