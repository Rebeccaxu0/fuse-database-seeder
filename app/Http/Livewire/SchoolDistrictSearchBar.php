<?php

namespace App\Http\Livewire;

use App\Models\District;
use App\Models\School;
use Illuminate\Database\Eloquent\Builder;
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
            ->orWhereHas(
                'district',
                function (Builder $query) {
                    $query->where('name', 'like', "%{$this->query}%");
                }
            )
            ->with('district')
            ->limit(10)
            ->orderBy('name')
            ->get();
    }

    public function render()
    {
        return view('livewire.school-district-search-bar');
    }
}
