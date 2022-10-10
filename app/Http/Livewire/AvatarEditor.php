<?php

namespace App\Http\Livewire;

use Livewire\Component;

class AvatarEditor extends Component
{
    public string $api_url = "https://avatars.dicebear.com/api/pixel-art/";
    public string $accessoriesColor = "#334545";
    public string $bgColor = "#0000ff";
    public string $clothesColor = "#0000ff";
    public string $glassesColor = "#334545";
    public string $hairColor = "#334545";
    public string $hatColor = "#334545";
    public string $mouthColor = "#0000ff";
    public string $skinColor = "#0000ff";
    public string $beard = "beardProbability=0";
    public string $eyes = "variant06";
    public string $eyebrows = "variant09";
    public string $mouth = "happy07";
    public string $hair = "hair[]=short01";
    public string $hairType = "short01";
    public string $seed = "fuse";

    public function mount()
    {
        // $this->previewImg = "{$this->http_api}{$this->seed}.svg";
    }

    public function updatedHairType($value)
    {
        if ($value == 'none') {
            $this->hair = 'hairProbability=0';
        }
        else {
            $this->hair = 'hair[]=' . $value;
        }
    }

    // public function updateImg()
    // {
    //     $this->seed = "dino";
    //     $this->previewImg = "{$this->http_api}{$this->seed}.svg";
    // }

    public function render()
    {
        return view('livewire.avatar-editor');
    }
}
