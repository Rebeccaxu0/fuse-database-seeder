<?php

namespace App\Http\Livewire;

use App\Models\District;
use App\Models\School;
use Livewire\Component;

class SchoolDistrictSearchBar extends Component
{
    public $query;

    public function selectDs($id)
    {
        $this->emitUp('dsSelected', $id);
        $this->query = '';
    }

    public function updatedQuery()
    {
        /*$this->dss = District::where('name', 'like', "%{$this->query}%")
            ->limit(5)
            ->get();*/
        $schools = School::where('name', 'like', "%{$this->query}%")
            ->limit(5);
        $districts = District::where('name', 'like', "%{$this->query}%")
            ->limit(5)
            ->get();
        $merged = $schools->merged($districts);
        $this->dss = $merged->all();
    }

    public function render()
    {
        return view('livewire.school-district-search-bar');
    }
}
