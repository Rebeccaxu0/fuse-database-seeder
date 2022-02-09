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

        if (Auth::user()->is_facilitator()) {
            $this->roleClass = 'fac';
        }
        if (Auth::user()->is_super_facilitator() || Auth::user()->is_admin()) {
            $this->roleClass = 'admin';
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
