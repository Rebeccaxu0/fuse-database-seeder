<?php

namespace App\Http\Livewire;

use Filestack\FilestackClient;
use Livewire\Component;

class FilestackPicker extends Component
{
    public bool $hidden;
    public ?string $fs_container;
    public ?string $fs_filename;
    public ?string $fs_handle;
    public ?string $fs_key;
    public ?string $fs_mimetype;
    public ?string $fs_originalFile_name;
    public ?string $fs_originalFile_size;
    public ?string $fs_originalFile_type;
    public ?string $fs_original_path;
    public ?string $fs_size;
    public ?string $fs_source;
    public ?string $fs_status;
    public ?string $fs_upload_id;
    public ?string $fs_url;
    public $preview;
    public $pickerOptions;

    protected $listeners = [
        'filestackUploadComplete',
        'filestackAppear',
        'filestackDisappear',
    ];

    private $filelink;
    private FilestackClient $fsClient;

    public function filestackUploadComplete($results)
    {
        if (empty($results['filesFailed'])) {
            $this->emit('makePreviewImage', 'filestack', ['fs_response' => $results['filesUploaded'][0]]);
        }
    }

    public function filestackAppear()
    {
        $this->hidden = false;
        $this->emit('fsPickerInit');
    }

    public function filestackDisappear()
    {
        $this->hidden = true;
    }

    public function mount()
    {
        $this->fsClient = new FilestackClient(config('filestack.api_key'));
        $this->pickerOptions = [
            'cleanupImageExif' => [
                'keepOrientation' => true,
                'keepICCandAPP' => true,
            ],
            'container' => '#Filestack-Picker',
            'disableTransformer' => true,
            'displayMode' => 'inline',
            'dropPane' => [
                'overlay' => false,
                'showIcon' => true,
                'showProgress' => true,
            ],
            'fromSources' => ['local_file_system', 'googledrive', 'webcam', 'audio', 'video'],
            'maxFiles' => 1,
            'startUploadingWhenMaxFilesReached' => true,
            'storeTo' => [
                // 'container' => 'fusestudio-student-uploads',
                'location' => 's3',
                'path' => auth()->user()->id . '/',
                'region' => 'us-east-2',
            ],
            'uploadInBackground' => false,
        ];
    }

    public function render()
    {
        return view('livewire.filestack-picker');
    }

}
