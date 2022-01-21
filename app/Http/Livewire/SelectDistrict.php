<?php

namespace App\Http\Livewire;

use App\Models\District;
use Livewire\Component;

class AddDistrict extends Component
{
    public $selecteddistricts= [];
    public $selecteddistrict;

    protected $listeners = ['districtSelected' => 'setDistrict'];

    public function setDistrict(District $district)
    {
        $this->selecteddistricts= [];
        $this->selecteddistricts[$district->id] = ['name' => $district->name];
    }

    public function removeDistrict($id)
    {
        unset($this->selecteddistricts[$id]);
    }

    public function render()
    {
        return view('livewire.add-district');
    }
}
