<?php

namespace App\View\Components;

use Illuminate\View\Component;

class NavLink extends Component
{
    /**
     * Is menu item active.
     * @var bool
     */
    public $active;

    /**
     * Create a new component instance.
     *
     * @return void
     */
    public function __construct($active)
    {
      $this->active = $active;
    }

    /**
     * Get the view / contents that represent the component.
     *
     * @return \Illuminate\Contracts\View\View|\Closure|string
     */
    public function render()
    {
        return view('components.nav-link');
    }
}
