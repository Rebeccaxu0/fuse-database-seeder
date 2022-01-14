<?php

namespace App\View\Components;

use Illuminate\View\Component;

class StudentNavbar extends Component
{

    /**
     * Create a new component instance.
     *
     * @return void
     */
    public function __construct()
    {
        // $links = [
        //   (object) ['route' => 'challenges', 'slot' => __('Challenges')],
        //   (object) ['route' => 'challenges', 'slot' => __('Help Finder')],
        //   (object) ['route' => 'challenges', 'slot' => __('Dashboard')],
        //   (object) ['route' => 'challenges', 'slot' => __('My Stuff')],
        // ];

        // parent::__construct('student', $links, 'fuse-teal-dk', '#3e3e3e', '4rem');

    }

    /**
     * Get the view / contents that represent the component.
     *
     * @return \Illuminate\Contracts\View\View|\Closure|string
     */
    public function render()
    {
        return view('student.navbar');
    }
}
