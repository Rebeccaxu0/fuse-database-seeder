<?php

namespace App\View\Components;

use App;
use App\Models\School;
use App\Models\User;
use Illuminate\Support\Facades\Cache;
use Illuminate\View\Component;
use NumberFormatter;

class Footer extends Component
{
    /**
     * Number of students/users.
     *
     * @var int
     */
    public $students;

    /**
     * Number of schools.
     *
     * @var int
     */
    public $schools;

    /**
     * Number of schools.
     *
     * @var int
     */
    public $states = 20;

    /**
     * Create a new component instance.
     *
     * @param int $students
     * @param int $schools
     *
     * @return void
     */
    public function __construct()
    {
        // $students = Cache::rememberForever('student_count', function () {
        //     return User::count();
        // });
        // $schools = Cache::rememberForever('school_count', function () {
        //     return School::count();
        // });
        // $ordinal = NumberFormatter::create(App::currentLocale(), NumberFormatter::DEFAULT_STYLE);
        // $this->students = $ordinal->format($students);
        // $this->schools = $ordinal->format($schools);
    }

    /**
     * Get the view / contents that represent the component.
     *
     * @return \Illuminate\Contracts\View\View|\Closure|string
     */
    public function render()
    {
        return view('components.footer');
    }
}
