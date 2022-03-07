<?php

namespace App\Http\Livewire;

use App\Models\District;
use Livewire\Component;

class DistrictSearchBar extends Component
{
    public $query;

    protected $queryString = ['id'];

    public function selectDistrict($id)
    {
        $this->emitUp('districtSelected', $id);
        $this->query = '';
        $this->id = $id;
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
