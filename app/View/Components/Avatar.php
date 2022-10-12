<?php

namespace App\View\Components;

use App\Models\User;
use Illuminate\View\Component;

class Avatar extends Component
{
    public User $user;

    /**
     * Create a new component instance.
     *
     * @return void
     */
    public function __construct(?User $user = null)
    {
        $this->user = $user ? $user : Auth::user();
    }

    /**
     * Get the view / contents that represent the component.
     *
     * @return \Illuminate\Contracts\View\View|\Closure|string
     */
    public function render()
    {
        return view('components.avatar', ['user' => $this->user]);
    }
}
