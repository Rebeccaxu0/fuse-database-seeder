<?php

namespace App\Http\Livewire\Admin;

use App\Http\Livewire\Toggle;

class UsersOnlineToggle extends Toggle
{
    // public string $property = '';

    public function toggle()
    {
        parent::toggle();
        $this->emitUp('toggleOnline');
    }

}

