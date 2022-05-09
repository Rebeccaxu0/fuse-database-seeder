<?php

namespace App\Http\Livewire;

use Livewire\Component;

class LevelSaveOrCompleteForm extends Component
{
    public bool $urlDisabled = false;
    public string $url = '';
    public string $previewUrl = '';
    public int $level_id;

    // As the parent, this component is the only one that needs to know about
    // its children. Siblings shouldn't know about each other to stay modular.
    protected $listeners = [
        'filestackUploadComplete',
        'filestackUploadDeleted',
        'uploadCodeValid',
        'uploadCodeInvalid',
        'makePreviewImage',
        'removePreview',
    ];

    protected $rules = [
        'url' => 'url',
    ];

    public function filestackUploadComplete()
    {
        $this->urlDisabled = true;
        $this->emit('uploadCodeDisable');
    }

    public function filestackUploadDeleted()
    {
        $this->urlDisabled = false;
        $this->emit('uploadCodeEnable');
    }

    public function uploadCodeValid()
    {
        $this->urlDisabled = true;
        $this->emit('filestackDisappear');
    }

    public function uploadCodeInvalid()
    {
        $this->urlDisabled = false;
        $this->emit('filestackAppear');
    }

    public function enableURL()
    {
        $this->urlDisabled = false;
        unset($this->previewUrl);
    }

    public function updatedUrl($url)
    {
        $this->validateOnly('url');
        if ($url == '') {
            $this->emit('urlInvalid');
            $this->emit('filestackAppear');
            $this->emit('uploadCodeEnable');
        }
        else {
            // Validate here.
            $this->emit('urlValid');
            $this->emit('filestackDisappear');
        }
    }

    public function removePreview()
    {
        $this->url = '';
        $this->urlDisabled = false;
        $this->emit('filestackAppear');
        $this->emit('uploadCodeReset');
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
        $fskey = env('FILESTACK_API_KEY');
        $validTypes = ['filestack', 'mobile upload code', 'url'];
        if (! in_array($type, $validTypes)) {
            // Throw exception;
            return;
        }

        $filename = $mime = '';

        if ($type == 'filestack') {
            $filelink = new Filelink($details['handle'], $fskey);
            $mime = explode('/', $filelink->getMetaData()['mimetype']);
            $filename = $filelink->getMetaData()['filename'];
        }
        else if ($type == 'mobile upload code') {
            $mime = $details['mime'];
        }

        // TODO: see if we can use Filestack to get a screenshot of the URL for type 'url'.
        $mimetype = explode('/', $this->mimetype($mime, $filename));

        switch($mimetype[0]) {
        case 'audio':
            // TODO: Audio icon svg.
            break;

        case 'video':
            // TODO: Video icon svg or preview still image.
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
        }
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
        if ($filemime != 'application/octet-stream' || $filename == '') {
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
}

