<?php

namespace App\Http\Livewire;

use Illuminate\Support\Facades\Http;
use Livewire\Component;

class UploadCode extends Component
{
    public bool $disabled = false;
    public string $uploadCode = '';

    protected $listeners = ['uploadCodeDisable', 'uploadCodeEnable', 'uploadCodeReset'];

    public function uploadCodeDisable()
    {
        $this->disabled = true;
    }

    public function uploadCodeEnable()
    {
        $this->disabled = false;
    }

    public function uploadCodeReset()
    {
        $this->uploadCode = '';
        $this->disabled = false;
    }

    public function updatedUploadCode($code)
    {
        if ($code == '') {
            $this->emit('uploadCodeInvalid');
        }
        else {
            // Validate here.
            $response = Http::get('https://api.fusestudio.net/validate/' . $code);
            if ($response->ok()) {
                $status = $response->json()['status'];
                if ($status == 'ready') {
                    $this->emit('uploadCodeValid');
                    $location = $response->json()['location'];
                    $mimetype = $response->json()['mimetype'];
                    $this->emit('makePreviewImage', 'mobile upload code', ['mime' => $mimetype, 'file_url' => $location]);
                }
            }
        }
    }

    public function render()
    {
        return view('livewire.upload-code');
    }
}
