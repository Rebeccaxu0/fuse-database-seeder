<?php

namespace App\View\Components;

use Illuminate\Support\Facades\Auth;
use Illuminate\View\Component;

class AppLayout extends Component
{
    public $rolePadding;

    /**
     * Create a new component instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->rolePadding = "4";
        
        if (Auth::user()->is_facilitator()) {
            $this->rolePadding = "6";
        }
        if (Auth::user()->is_super_facilitator() || Auth::user()->is_admin()) {
            $this->rolePadding = "8";
        }
    }

    /**
     * Get the view / contents that represents the component.
     *
     * @return \Illuminate\View\View
     */
    public function render()
    {
        return view('layouts.app');
    }
}
