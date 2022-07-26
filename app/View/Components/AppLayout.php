<?php

namespace App\View\Components;

use App\Models\User;
use Illuminate\View\Component;

class AppLayout extends Component
{ 
    public ?User $avatarUser = null;

    public function __construct(?User $avatarUser = null)
    {
        $this->avatarUser = $avatarUser;
    }

    /**
     * Get the view / contents that represents the component.
     *
     * @return \Illuminate\View\View
     */
    public function render()
    {
        return view('layouts.app', ['avatarUser' => $this->avatarUser]);
    }
}
