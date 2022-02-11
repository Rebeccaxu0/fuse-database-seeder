<?php

namespace App\Http\Livewire\Facilitator;

use Livewire\Component;

class AddStudentsToStudioByCsv extends Component
{
    public bool $showImportStudentsByCsvModal = false;

    public function render()
    {
        return view('livewire.facilitator.add-students-to-studio-by-csv');
    }
}
