<?php

namespace App\View\Components;

use Illuminate\Support\Facades\Auth;
use Illuminate\View\Component;

class BaseLayout extends Component
{
    public $roleClass;

    /**
     * Create a new component instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->roleClass = 'student';

        if (Auth::user()->isAdmin()) {
            $this->roleClass = 'admin';
        }
        else if (Auth::user()->isFacilitator()
          || Auth::user()->isSuperFacilitator()) {
            $this->roleClass = 'fac';
        }
    }

    /**
     * Get the view / contents that represents the component.
     *
     * @return \Illuminate\View\View
     */
    public function render()
    {
        return view('layouts.base');
    }
}
