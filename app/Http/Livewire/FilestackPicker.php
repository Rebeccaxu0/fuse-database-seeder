<?php

namespace App\Http\Livewire;

use Filestack\Filelink;
use Filestack\FilestackClient;
use Livewire\Component;

class FilestackPicker extends Component
{
    public bool $hidden;
    public $preview;
    public $pickerOptions;

    public array $hiddenInputs = [
        'fs-filename',
        'fs-handle',
        'fs-key',
        'fs-mimetype',
        'fs-original_path',
        'fs-size',
        'fs-source',
        'fs-status',
        'fs-upload_id',
        'fs-url',
    ];

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
            $this->emit('makePreviewImage', 'filestack', $results['filesUploaded'][0]['handle']);
            // TODO: update all the hidden inputs.
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
        $this->fsClient = new FilestackClient(env('FILESTACK_API_KEY'));
        $this->pickerOptions = [
            'cleanupImageExif' => [
                'keepOrientation' => true,
                'keepICCandAPP' => true
            ],
            'container' => '#Filestack-Picker',
            'disableTransformer' => true,
            'displayMode' => 'inline',
            'dropPane' => [
                'overlay' => false,
                'showIcon' => true,
                'showProgress' => true
            ],
            'fromSources' => ['local_file_system', 'googledrive', 'webcam', 'audio', 'video'],
            'maxFiles' => 1,
            'startUploadingWhenMaxFilesReached' => true,
            'storeTo' => [
                'container' => 'fusestudio-student-uploads',
                'location' => 's3',
                'path' => auth()->user()->id . '/',
                'region' => 'us-east-1'
            ],
            'uploadInBackground' => false
        ];
    }

    public function render()
    {
        return view('livewire.filestack-picker');
    }

}
