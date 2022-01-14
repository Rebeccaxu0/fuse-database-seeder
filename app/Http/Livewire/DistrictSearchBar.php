<?php

namespace App\Http\Livewire;

use App\Models\District;
use Livewire\Component;

class DistrictSearchBar extends Component
{
    public $query;

    public $show = true;


    protected $listeners = ['addDistrict' => 'hide', 'removeDistrict' => 'show',];

    public function show(){
        $show = true;

    }
    
    public function hide(){
        $show = false;

    }
    
    public function selectDistrict($id)
    {
        $this->emitUp('districtSelected', $id);
        $this->query = '';
    }

    public function updatedQuery()
    {
        $this->districts = District::where('name', 'like', "%{$this->query}%")
            ->limit(10)
            ->get();
    }

    public function render()
    {
        return view('livewire.district-search-bar');
    }
}
