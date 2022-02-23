<?php

namespace App\Http\Livewire;

use Livewire\Component;
use App\Models\District;
use App\Models\School;
use App\Models\Studio;

class StudioIndex extends Component

{
    public $showStudios = false;

    protected $listeners = ['districtSelected' => 'setDistrict', 'schoolSelected'=> 'setSchool', 'dsSelected'=> 'setDs',];

    public function setDistrict(District $district)
    {
        $this->setdistrict = $district;
        $this->showStudios = true;
        $this->setSchool($this->setdistrict->schools->first());
        return $this->setdistrict;
    }

    public function setDs($item)
    {
        /*if (item is school)..
        setSchool($item);
        if (item is district).. 
        setDistrict($item);     */
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
