<?php

namespace App\View\Components;

use Illuminate\View\Component;

class NavLink extends Component
{
    /**
     * Value of href.
     * @var text
     */
    public $route;

    /**
     * Is menu item active.
     * @var bool
     */
    public $active;

    /**
     * Slot.
     * @var text
     */
    public $text;

    /**
     * Create a new component instance.
     *
     * @return void
     */
    public function __construct($menu_item)
    {
      $this->route = $menu_item->route;
      $this->active = $menu_item->active;
      $this->text = $menu_item->text;
    }

    /**
     * Get the view / contents that represent the component.
     *
     * @return \Illuminate\Contracts\View\View|\Closure|string
     */
    public function render()
    {
        return view('components.nav-link', [$route, $active, $text]);
    }
}
