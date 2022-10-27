<?php

namespace App\Http\Livewire\Admin;

use App\Models\Media;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Gate;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;
use Livewire\Component;
use Livewire\WithFileUploads;
use Livewire\WithPagination;
use MediaUploader;
use Plank\Mediable\Helpers\File;
// use Plank\Mediable\Media;

class MediaManagerPage extends Component
{
    use WithFileUploads;
    use WithPagination;

    public bool $showFileEditModal = false;
    public bool $showFileDeleteModal = false;
    public ?int $targetFileId = null;
    public ?string $targetFileFilename = null;
    public ?string $targetFileExtension = null;
    public ?string $targetFileAltText = null;
    public string $currentLocation = '';
    public array $currentLocationArray = [];
    public array $subdirectories = [];
    public string $fileSearch = '';
    public bool $onlyImages = false;
    public string $fsdisk = 'public';
    public string $newSubdir = '';
    public $fileToUpload;

    protected $listeners = [
        'toggleImages',
         'livewire-upload-finish' => 'upload',
        ];
    protected $queryString = [
        'fsdisk' => ['except' => ''],
        'onlyImages' => ['except' => false, 'as' => 'images'],
        'page' => ['except' => 1, 'as' => 'p'],
        'fileSearch' => ['except' => '', 'as' => 's'],
        'currentLocation' => ['except' => '', 'as' => 'folder'],
    ];

    public function toggleImages() {
        $this->onlyImages = ! $this->onlyImages;
    }

    public function updatedFileSearch()
    {
        $this->resetPage();
    }

    public function mount()
    {
        Gate::allowIf(Auth::user()->isAdmin());
        if ($this->currentLocation != '') {
            $this->currentLocationArray = explode('/', $this->currentLocation);
        }
    }

    public function deleteModal(int $mediaId)
    {
        $this->setTargetFile($mediaId);
        $this->targetFileId = $mediaId;
        $this->showFileDeleteModal = true;
    }

    public function editModal(int $mediaId)
    {
        $this->setTargetFile($mediaId);
        $this->showFileEditModal = true;
    }

    public function saveEdits()
    {
        $file = Media::find($this->targetFileId);
        $file->alt = $this->targetFileAltText;
        $file->save();
        $this->resetTargetFile();
        $this->showFileEditModal = false;
    }

    public function updatedShowFileEditModal($value)
    {
        if (! $value) { $this->resetTargetFile(); }
    }

    public function makeSubdir()
    {
        if (Str::of($this->newSubdir)->test('/[\w\d]+/')) {
            $directory = $this->currentLocation . '/' . $this->newSubdir . '/.temp';
            Storage::disk($this->fsdisk)->put($directory, '');
            $this->newSubdir = '';
        }
    }

    public function delete()
    {
        $media = Media::find($this->targetFileId);
        $media->forceDelete();
        $this->resetTargetFile();
        $this->showFileDeleteModal = false;
    }
    public function upload()
    {
        $file = $this->fileToUpload
            ->storeAs($this->currentLocation, $this->fileToUpload->getClientOriginalName(), $this->fsdisk);
        MediaUploader::importPath($this->fsdisk, $file);
    }

    public function setFSDisk(string $fsdisk)
    {
        $disks = ['public', 'artifacts'];
        if (in_array($fsdisk, $disks)) {
            $this->fsdisk = $fsdisk;
        }
    }

    public function navigateBack(int $depth)
    {
        if ($depth >= 0) {
            $targetLocation = '';
            for ($index = 0; $index <= $depth; $index++) {
                $targetLocation .= "/{$this->currentLocationArray[$index]}";
                $targetLocationArray[] = $this->currentLocationArray[$index];
            }
            $this->currentLocation = $targetLocation;
            $this->currentLocationArray = $targetLocationArray;
        }
        else {
            $this->currentLocation = '';
            $this->currentLocationArray = [];
        }
    }

    public function navigateForward(int $subdir_index)
    {
        if ($subdir_index < count($this->subdirectories)) {
            $this->currentLocationArray[] = $this->subdirectories[$subdir_index];
            $this->currentLocation = implode('/', $this->currentLocationArray);
        }
    }

    public function refresh()
    {
        $diskFiles = Storage::disk($this->fsdisk)->files($this->currentLocation);
        $mediaRecords = Media::inDirectory($this->fsdisk, $this->currentLocation)->get();
        // Emulate Artisan command 'sync' which is just 'prune' then 'import'.
        // https://github.com/plank/laravel-mediable/blob/master/src/Commands/SyncMediaCommand.php
        // https://github.com/plank/laravel-mediable/blob/master/src/Commands/PruneMediaCommand.php
        // https://github.com/plank/laravel-mediable/blob/master/src/Commands/ImportMediaCommand.php
        foreach ($mediaRecords as $media) {
            if (! $media->fileExists()) {
                $media->delete();
            }
        }
        // Update Media Records.
        $mediaRecords = Media::inDirectory($this->fsdisk, $this->currentLocation)->get();
        foreach ($diskFiles as $path) {
            if ($record = $this->getRecordForFile($path, $mediaRecords)) {
                $this->updateRecordForFile($record, $path);
            } else {
                $this->createRecordForFile($this->fsdisk, $path);
            }
        }
    }

    /**
     * Search through the record list for one matching the provided path.
     * @param  string $path
     * @param  Collection $existingMedia
     * @return Media|null
     */
    protected function getRecordForFile(string $path, Collection $existingMedia): ?Media
    {
        $directory = File::cleanDirname($path);
        $filename = pathinfo($path, PATHINFO_FILENAME);
        $extension = pathinfo($path, PATHINFO_EXTENSION);

        return $existingMedia->filter(function (Media $media) use ($directory, $filename, $extension) {
            return $media->directory == $directory && $media->filename == $filename && $media->extension == $extension;
        })->first();
    }

    /**
     * Generate a new media record.
     * @param  string $disk
     * @param  string $path
     * @return void
     */
    protected function createRecordForFile(string $disk, string $path): void
    {
        try {
            MediaUploader::importPath($disk, $path);
        } catch (MediaUploadException $e) {
            $this->warn($e->getMessage(), 'vvv');
        }
    }

    /**
     * Update an existing media record.
     * @param  \Plank\Mediable\Media $media
     * @param  string $path
     * @return void
     */
    protected function updateRecordForFile(Media $media, string $path): void
    {
        try {
            MediaUploader::update($media);
        } catch (MediaUploadException $e) {
            $this->warn($e->getMessage(), 'vvv');
        }
    }

    public function render()
    {
        $disk = Storage::disk($this->fsdisk);
        $fullPathSubdirectories = $disk->directories('/' . $this->currentLocation);
        $this->subdirectories = [];
        foreach ($fullPathSubdirectories as $fullpath) {
            $patharray = explode('/', $fullpath);
            $this->subdirectories[] = array_pop($patharray);
        }
        $files = Media::inDirectory($this->fsdisk, $this->currentLocation);
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
        return view('livewire.admin.media-manager', ['files' => $files]);
    }

    private function resetTargetFile()
    {
        $this->targetFileId = null;
        $this->targetFileFilename = null;
        $this->targetFileExtension = null;
        $this->targetFileAltText = null;
    }

    private function setTargetFile(int $mediaId)
    {
        $file = Media::find($mediaId);
        $this->targetFileId = $mediaId;
        $this->targetFileFilename = $file->filename;
        $this->targetFileExtension = $file->extension;
        $this->targetFileAltText = $file->alt;
    }
}
