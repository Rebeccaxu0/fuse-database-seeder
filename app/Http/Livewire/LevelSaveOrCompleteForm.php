<?php

namespace App\Http\Livewire;

use App\Rules\UploadCode;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Http;
use Illuminate\Validation\Rule;
use Livewire\Component;

class LevelSaveOrCompleteForm extends Component
{
    public bool $uploadCodeDisappear = false;
    public bool $urlDisappear = false;
    public bool $uploadCodeDisabled = false;
    public bool $urlDisabled = false;
    public string $uploadCode = '';
    public string $url = '';
    public string $previewUrl = '';
    public int $lid;
    public int $uid;
    public string $type = 'save';
    public string $filestackHandle;
    public string $artifactName;
    public string $notes;
    public string $teammates;

    // As the parent, this component is the only one that needs to know about
    // its children. Siblings shouldn't know about each other to stay modular.
    protected $listeners = [
        'filestackUploadComplete',
        'filestackUploadDeleted',
        'makePreviewImage',
        'removePreview',
    ];

    public function filestackUploadComplete()
    {
        $this->uploadCodeDisabled = true;
        $this->urlDisabled = true;
    }

    public function filestackUploadDeleted()
    {
        $this->uploadCodeDisabled = false;
        $this->urlDisabled = false;
    }

    public function enableURL()
    {
        $this->urlDisabled = false;
        unset($this->previewUrl);
    }

    public function updatedUploadCode($code)
    {
        if ($code == '') {
            $this->emit('filestackAppear');
            $this->urlDisabled = false;
        }
        else {
            $this->url = '';
            $this->urlDisabled = true;
            // Validate here.
            $response = Http::get('https://api.fusestudio.net/validate/' . $code);
            if ($response->ok()) {
                $status = $response->json()['status'];
                if ($status == 'ready') {
                    $this->emit('filestackDisappear');
                    $location = $response->json()['location'];
                    $mimetype = $response->json()['mimetype'];
                    $this->emit('makePreviewImage', 'mobile upload code', ['mime' => $mimetype, 'file_url' => $location]);
                }
            }
        }
    }

    public function updatedUrl($url)
    {
        if ($url == '') {
            $this->emit('filestackAppear');
            $this->uploadCodeDisabled = false;
            $this->validateOnly('url');
        }
        else {
            $this->validateOnly('url');
            $this->emit('filestackDisappear');
            $this->uploadCodeDisabled = true;
            $this->makePreviewImage('url', ['url' => $url]);
        }
    }

    public function removePreview()
    {
        $this->uploadCode = '';
        $this->uploadCodeDisabled = false;
        $this->uploadCodeDisappear = false;
        $this->url = '';
        $this->urlDisabled = false;
        $this->urlDisappear = false;
        $this->emit('filestackAppear');
        unset($this->previewUrl);
    }

    /**
     * Populates the preview image/icon based on the method and details.
     *
     * @param string $type
     *   Valid options are 'filestack', 'mobile upload code', and 'url'.
     * @param array $details
     *   Contents vary based on type.
     *   'filestack' implies key of 'handle' to hydrate a Filestack\Filelink object.
     *   'mobile upload code' implies keys of 'mime' and 'file_url'
     *   'url' implies key of 'url'
     */
    public function makePreviewImage(string $type, array $details)
    {
        // If there's a valid preview, hide upload inputs.
        $this->uploadCodeDisappear = true;
        $this->urlDisappear = true;
        $this->emit('filestackDisappear');

        $fskey = config('filestack.api_key');
        $validTypes = ['filestack', 'mobile upload code', 'url'];
        if (! in_array($type, $validTypes)) {
            // Throw exception;
            return;
        }

        if ('url' == $type) {
            // TODO: see if we can use Filestack to get a screenshot of the URL for type 'url'.
            $this->previewUrl = '/img/link.svg';
            $this->previewName = $details['url'];
            return;
        }

        $filename = $mime = '';

        if ($type == 'filestack') {
            $filelink = new Filelink($details['handle'], $fskey);
            $mime = explode('/', $filelink->getMetaData()['mimetype']);
            $filename = $filelink->getMetaData()['filename'];
            $this->previewName = $filename;
        }
        else if ($type == 'mobile upload code') {
            $mime = $details['mime'];
            $url = $details['file_url'];
            $exploded_url = explode('/', $url);
            $this->previewName = $filename = array_pop($exploded_url);
        }

        $mimetype = explode('/', $this->mimetype($mime, $filename));
        $this->previewName = $this->previewName;

        switch($mimetype[0]) {
        case 'audio':
            $this->previewUrl = '/img/audio.svg';
            break;

        case 'video':
            $this->previewUrl = '/img/video.svg';
            break;

        case 'image':
            if ($type == 'filestack') {
                $this->previewUrl = $filelink->resize(100, 75, 'crop')->transform_url;
            }
            else {
                $this->previewUrl = "https://cdn.art.fusestudio.net/{$fskey}/resize=w:100,h:75,fit:crop/src://fuse/{$details['file_url']}";
            }
            break;

        default:
            $this->previewUrl = '/img/misc.svg';
        }
    }

    public function makeArtifact()
    {
        $this->validate();
    }

    public function mount()
    {
    }

    public function render()
    {
        return view('livewire.level-save-or-complete-form');
    }

    /**
     * Get more accurate mimetype
     *
     * Some binary files self-report as 'application/octet-stream' when they're
     * actually images or videos.
     * This function guesses based on extension for those mimetypes.
     * See https://www.sitepoint.com/mime-types-complete-list/
     *
     * @param string $filemime
     *  Mimetype.
     * @param string $filename
     *  Filename.
     *
     * @return string
     *  Updated mimetype.
     */
    function mimetype($filemime, $filename = '') {
        if ($filename == '' || ($filemime != '' && $filemime != 'application/octet-stream')) {
            return $filemime;
        }
        $name_boom = explode('.', $filename);
        $ext = strtolower(array_pop($name_boom));
        if ('jpg' == $ext || 'jpeg' == $ext) {
            $filemime = 'image/jpeg';
        }
        else if ('gif' == $ext) {
            $filemime = 'image/gif';
        }
        else if ('png' == $ext) {
            $filemime = 'image/png';
        }
        else if ('mp2' == $ext) {
            $filemime = 'audio/mpeg';
        }
        else if ('mp3' == $ext) {
            $filemime = 'audio/mpeg3';
        }
        else if ('avi' == $ext) {
            $filemime = 'video/avi';
        }
        else if ('mkv' == $ext) {
            $filemime = 'video/x-matroska';
        }
        else if ('m1v' == $ext || 'm2v' == $ext || 'mpeg' == $ext || 'mpg' == $ext) {
            $filemime = 'video/mpeg';
        }
        else if ('mov' == $ext || 'moov' == $ext || 'qt' == $ext) {
            $filemime = 'video/quicktime';
        }
        else if ('mp4' == $ext) {
            $filemime = 'video/mp4';
        }
        return $filemime;
    }

    protected function rules()
    {
        return [
            'lid' => 'int|exists:App\Models\Level,id',
            'uid' => ['int', 'exists:App\Models\User,id', Rule::in([Auth::user()->id])],
            'type' => ['required', 'regex:/^(save)|(complete)$/'],
            'filestackHandle' => 'required_without_all:url,uploadcode',
            'uploadCode' => ['required_without_all:file,url', 'max:10', new UploadCode],
            'url' => 'required_without_all:file,uploadcode|nullable|url|max:2048',
            'artifactName' => 'max:255',
            'notes' => 'max:4098',
            'teammates.*' => 'int',
        ];
    }
}

