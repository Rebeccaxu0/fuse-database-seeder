<?php

namespace App\Http\Livewire;

use App\Models\Studio;
use Livewire\Component;

class StudioSearchBar extends Component
{
    public $query;

    public function selectStudio($id)
    {
        $this->emitUp('studioSelected', $id);
        $this->query = '';
    }

    public function updatedQuery()
    {
        $this->studios = Studio::where('name', 'like', "%{$this->query}%")
            ->limit(10)
            ->get();
    }

    public function render()
    {
        return view('livewire.studio-search-bar');
    }
}
