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
        $this->dss = School::where('name', 'like', "%{$this->query}%")
            ->limit(10)
            ->get();
        
        /*$districts = School::whereHas('district',
            function (Builder $query)  {
                $query->where($district->name, 'like', "%{$this->query}%");})
                ->union($schools)
                ->get();*/
        
    }

    public function render()
    {
        return view('livewire.school-district-search-bar');
    }
}
