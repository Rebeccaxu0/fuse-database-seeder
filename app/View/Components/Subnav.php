<?php

namespace App\View\Components;

use Illuminate\View\Component;

class Subnav extends Component
{
    /**
     * Navbar identifier.
     *
     * @var string
     */
    public $id;

    /**
     * Hamburger color.
     *
     * @var string
     */
    public $hamburgerColor;

    /**
     * Create a new component instance.
     *
     * @param string $id
     * @param string $hamburgerColor
     * @return void
     */
    public function __construct($id, $hamburgerColor = 'text-white')
    {
        $this->id = $id;
        $this->hamburgerColor = $hamburgerColor;
    }

    /**
     * Get the view / contents that represent the component.
     *
     * @return \Illuminate\Contracts\View\View|\Closure|string
     */
    public function render()
    {
        return view('components.subnav');
    }
}
