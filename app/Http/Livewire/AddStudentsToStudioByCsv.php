<?php

namespace App\Http\Livewire;

use Livewire\Component;

class AddStudentsToStudioByCsv extends Component
{
    public bool $showImportStudentsByCsvModal = false;

    public function render()
    {
        return view('livewire.add-students-to-studio-by-csv');
    }
}
