<?php

namespace App\Http\Livewire\Admin;

use App\Models\User;
use Livewire\Component;
use Livewire\WithPagination;

class UsersPage extends Component
{
    use WithPagination;

    public string $userSearch = '';

    public function mount()
    {
    }

    public function updatedUserSearch()
    {
        $this->resetPage();
    }

    public function render()
    {
      return view('livewire.admin.users-page', [
        'users' => User::search($this->userSearch)
          ->orderBy('full_name')
          ->paginate(15)
      ]);
    }
}
