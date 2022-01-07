<?php

namespace App\Http\Livewire;

use App\Models\District;
use Livewire\Component;

class AddDistrict extends Component
{
    public $selecteddistrict;

    protected $listeners = ['districtSelected' => 'addDistrict'];

    public function addDistrict(District $district)
    {
      $this->selectedschool = $district;
    }

    public function render()
    {
        return view('livewire.add-district');
    }
}
