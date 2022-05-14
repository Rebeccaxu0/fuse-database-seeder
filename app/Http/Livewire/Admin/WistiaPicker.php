<?php

namespace App\Http\Livewire\Admin;

use Illuminate\Support\Facades\Http;
use Livewire\Component;

class WistiaPicker extends Component
{
    public string $thumbnail = '';
    public string $label = 'Wistia ID';
    public string $name = 'wistiaId';
    public string $wistiaId = '';

    public function mount(string $wistiaId = '')
    {
        if ($wistiaId != '') {
            $this->updatedWistiaId($wistiaId);
        }
    }

    public function updatedWistiaId($id)
    {
        if ($id) {
            $response = Http::acceptJson()
                ->withToken(config('wistia.token'))
                ->get('https://api.wistia.com/v1/medias/' . $id);
            if ($response->ok()) {
                $this->thumbnail = $response->json('thumbnail.url');
            }
            else {
                $this->thumbnail = '';
            }
        }
        else {
            $this->thumbnail = '';
        }
    }

    public function render()
    {
        return view('livewire.admin.wistia-picker');
    }
}
