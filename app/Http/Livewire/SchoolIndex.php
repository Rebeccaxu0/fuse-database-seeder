<?php

namespace App\Http\Livewire;

use App\Models\District;
use App\Models\School;
use Livewire\Component;

class SchoolIndex extends Component
{
    public $showSchools = false;

    protected $listeners = ['districtSelected' => 'setDistrict'];

    public function __construct() {
        $this->setdistrict = $this->setDistrict(District::all()->first());
    }

    public function setDistrict(District $district)
    {
        $this->setdistrict = $district;
        $this->showSchools = true;
        return $this->setdistrict;
    }

    public function removeDistrict()
    {
        $this->setdistrict = null;
    }

    public function render()
    {
        return view('livewire.school-index', [
            'studios' => School::all(),
        ]);
    }
}

