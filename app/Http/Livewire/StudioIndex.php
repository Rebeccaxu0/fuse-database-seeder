<?php

namespace App\Http\Livewire;

use App\Models\District;
use App\Models\School;
use App\Models\Studio;
use Livewire\Component;

class StudioIndex extends Component

{
    public School $school;

    protected $listeners = ['dsSelected'=> 'setDs'];

    public function setDs(int $school_id)
    {
        $this->school = School::find($school_id);
    }

    public function __construct() {
      $this->school = District::all()->first()->schools()->first();

    }


    public function render()
    {
        return view('livewire.studio-index');
    }
}
