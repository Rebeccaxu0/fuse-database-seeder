<?php

namespace App\View\Components;

use Illuminate\Support\Facades\Auth;
use Illuminate\View\Component;

class FacilitatorNav extends Component
{
    /**
     * Create a new component instance.
     *
     * @return void
     */
    public function __construct()
    {
        //
    }

    /**
     * Get the view / contents that represent the component.
     *
     * @return \Illuminate\Contracts\View\View|\Closure|string
     */
    public function render()
    {
      $view = null;
      if ( Auth::user()->is_facilitator()
        || Auth::user()->is_super_facilitator()
        || Auth::user()->is_admin()) {
        $view = view('components.fac-nav');
      }
      return $view;
    }
}
