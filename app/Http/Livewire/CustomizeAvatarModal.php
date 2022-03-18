<?php

namespace App\Http\Livewire;

use App\Models\User;
use Livewire\Component;

class CustomizeAvatarModal extends Component
{
    public bool $showModalFlag = false;
    public User $user;

    public function render()
    {
        return view('livewire.customize-avatar-modal');
    }
}
