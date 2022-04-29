<?php

namespace App\Http\Livewire\Admin;

use App\Models\Media;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Storage;
use Livewire\Component;
use Livewire\WithPagination;

class MediaManagerPage extends Component
{
    use WithPagination;

    public string $current_dir = '';
    public string $fileSearch = '';
    public bool $onlyImages = false;

    protected $listeners = ['toggleImages'];
    protected $queryString = [
        'onlyImages' => ['except' => false, 'as' => 'images'],
        'page' => ['except' => 1, 'as' => 'p'],
        'fileSearch' => ['except' => '', 'as' => 's'],
    ];

    public function toggleImages() {
        $this->onlyImages = ! $this->onlyImages;
    }

    public function updatedFileSearch()
    {
        $this->resetPage();
    }

    public function render()
    {
        $public = Storage::disk('public');
        $directories = $public->directories('/' . $this->current_dir);
        $directories = DB::table('media')
            ->select('directory')
            ->distinct()
            ->orderBy('directory')
            ->get();
        $files = Media::inDirectory('public', $this->current_dir);
        if (strlen($this->fileSearch) > 2) {
            $files = $files->where('filename', 'like', "%{$this->fileSearch}%");
        }
        if ($this->onlyImages) {
            $files = $files->whereIn('aggregate_type', [Media::TYPE_IMAGE, Media::TYPE_IMAGE_VECTOR]);
        }
        if ($this->fileSearch) {
            $files = $files->whereIn('aggregate_type', [Media::TYPE_IMAGE, Media::TYPE_IMAGE_VECTOR]);
        }
        $files = $files->orderBy('filename')
                       ->paginate(15);
        return view('livewire.admin.media-manager', [
            'directories' => $directories,
            'files' => $files
        ]);
    }
}
