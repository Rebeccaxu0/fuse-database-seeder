<?php

namespace App\View\Components;

use Illuminate\Support\Facades\Auth;
use Illuminate\View\Component;

class FacilitatorSubnav extends Component
{
    /**
     * Create a new component instance.
     *
     * @return void
     */
    public function __construct()
    {

        // parent::__construct('facilitator', $links, 'fuse-green', '#136b23');

    }

    /**
     * Get the view / contents that represent the component.
     *
     * @return \Illuminate\Contracts\View\View|\Closure|string
     */
    public function render()
    {
        $view = null;
        if (
            Auth::user()->isFacilitator()
            || Auth::user()->isSuperFacilitator()
            || Auth::user()->isAdmin()
        ) {
            $view = view('facilitator.subnav');
        }
        return $view;
    }
}
