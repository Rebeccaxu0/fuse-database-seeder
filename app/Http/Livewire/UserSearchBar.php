<?php

namespace App\Http\Livewire;

use App\Models\User;
use Livewire\Component;

class UserSearchBar extends Component
{
    public $query;

    public function selectUser($id)
    {
      $this->emitUp('userSelected', $id);
      $this->query = '';
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
