<?php

namespace App\Http\Livewire;

use Livewire\Component;
use App\Models\District;
use App\Models\School;
use App\Models\Studio;

class StudioIndex extends Component

{
    public $showStudios = false;

    protected $listeners = ['dsSelected'=> 'setDs'];

    public function setDs(School $ds)
    {
        $this->setSchool($ds);
        $this->showStudios = true;
    }
    
    public function setDistrict(District $district)
    {
        $this->setdistrict = $district;
        return $this->setdistrict;
    }

    public function setSchool(School $school)
    {
        $this->setschool = $school;
        $this->setDistrict($school->district);
        return $this->setschool;
    }

    public function removeSchool()
    {
        $this->setschool = null;
    }

    public function removeDistrict()
    {
        $this->setdistrict = null;
    }

    public function __construct() {
    
        $this->setdistrict = $this->setDistrict(District::all()->first());
        $this->setschool = $this->setSchool($this->setdistrict->schools()->first());

    }


    public function render()
    {
        return view('livewire.studio-index', [
            'studios' => Studio::all(),
        ]);
    }
}
