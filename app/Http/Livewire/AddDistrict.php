<?php

namespace App\Http\Livewire;

use App\Models\District;
use Livewire\Component;

class AddDistrict extends Component
{
    public ?District $district = null;

    protected $listeners = ['districtSelected' => 'addDistrict'];

    public function addDistrict(District $district)
    {
        $this->district = $district;
    }

    public function removeDistrict()
    {
        unset($this->district);
    }

    public function render()
    {
        return view('livewire.add-district');
    }
}
