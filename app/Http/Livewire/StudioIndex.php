<?php

namespace App\Http\Livewire;

use App\Models\District;
use App\Models\School;
use App\Models\Studio;
use Livewire\Component;

class StudioIndex extends Component

{
    public $showStudios = false;

    protected $listeners = ['districtSelected' => 'setDistrict', 'schoolSelected'=> 'setSchool'];

    public function __construct() {
        $this->setdistrict = $this->setDistrict(District::all()->first());
        $this->setschool = $this->setSchool($this->setdistrict->schools()->first());
    }

    public function setDistrict(District $district)
    {
        $this->setdistrict = $district;
        $this->showStudios = true;
        $this->setSchool($this->setdistrict->schools->first());
        return $this->setdistrict;
    }

    public function removeDistrict()
    {
        $this->setdistrict = null;
    }

    public function setSchool(School $school)
    {
        $this->setschool = $school;
        $this->showStudios = true;
        // if ($this->setschool->district->first() != $this->setdistrict){
        //$this->setdistrict = $this->setschool->district->first();
        //}
        return $this->setschool;
    }

    public function removeSchool()
    {
        $this->setschool = null;
    }

    public function render()
    {
        return view('livewire.studio-index', [
            'studios' => Studio::all(),
        ]);
    }
}
