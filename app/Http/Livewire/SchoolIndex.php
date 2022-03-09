<?php

namespace App\Http\Livewire;

use App\Models\District;
use App\Models\School;
use Livewire\Component;

class SchoolIndex extends Component
{
    public $showSchools = false;
    public $districtFilter = null;

    protected $queryString = [
        'districtFilter' => ['except' => null, 'as' => 'district']
    ];

    protected $listeners = ['districtSelected' => 'setDistrict'];

    public function mount() {
        if ($this->districtFilter) {
            $this->setDistrict(District::find($this->districtFilter));
        }
        else {
            $this->setDistrict(District::all()->first());
            $this->districtFilter = null;
        }
    }

    public function setDistrict(District $district)
    {
        $this->setdistrict = $district;
        $this->showSchools = true;
        $this->districtFilter = $this->setdistrict->id;
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

