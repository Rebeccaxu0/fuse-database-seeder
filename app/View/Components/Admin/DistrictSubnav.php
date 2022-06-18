<?php

namespace App\View\Components\Admin;

use Illuminate\View\Component;

class DistrictSubnav extends Component
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

    /**Challenge
     * Get the view / contents that represent the component.
     *
     * @return \Illuminate\Contracts\View\View|\Closure|string
     */
    public function render()
    {
        return view('admin.district-subnav');
    }
}
