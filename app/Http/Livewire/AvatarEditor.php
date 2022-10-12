<?php

namespace App\Http\Livewire;

use App\Models\User;
use Illuminate\Support\Facades\Auth;
use Livewire\Component;

class AvatarEditor extends Component
{
    public string $api_url = 'https://avatars.dicebear.com/api/pixel-art/';
    public User $user;

    public string $accessoriesColor = '#DAA520';
    public string $backgroundColor = '#6e59ac';
    public string $clothesColor = '#FF6F69';
    public string $glassesColor = '#5F705C';
    public string $hairColor = '#603A14';
    public string $hatColor = '#CC6192';
    public string $mouthColor = '#C98276';
    public string $skinColor = '#F5CFA0';
    public string $accessories = 'accessoriesProbability=0';
    public string $beard = 'beardProbability=0';
    public string $clothing = 'variant06';
    public string $eyes = 'variant06';
    public string $eyebrows = 'variant08';
    public string $glasses = 'glassesProbability=0';
    public string $hat = 'hatProbability=0';
    public string $mouth = 'happy07';
    public string $hair = 'hair[]=short09';
    public string $profileAvatarUrl;

    public array $accessoriesColorOptions = ['#DAA520', '#FFD700', '#FAFAD2', '#D3D3D3', '#A9A9A9'];
    public array $accessoryOptions = [];
    public array $backgroundColorOptions = ['#EBEBEB', '#83C9E3', '#6CB306', '#E46634', '#E22659', '#6E59AC', '#C10000', '#297F9E', '#086384', '#F7E70B'];
    public array $beardOptions = [];
    public array $clothesColorOptions = ['#FF6F69', '#D11141', '#AE0001', '#FFEEAD', '#FFD969', '#FFC425', '#88D8B0', '#44C585', '#00B159', '#5BC0DE', '#428BCA', '#03396C'];
    public array $clothingOptions = [];
    public array $eyebrowsOptions = [];
    public array $eyesOptions = [];
    public array $glassesColorOptions = ['#5F705C', '#43677D', '#A04B5D', '#4B4B4B', '#323232', '#191919'];
    public array $glassesOptions = [];
    public array $hairColorOptions = ['#CAB188', '#A78961', '#83623B', '#603A14', '#603015', '#612616', '#611C17', '#4E1A13', '#3B170E', '#28150A'];
    public array $hairOptions = [];
    public array $hatColorOptions = ['#CC6192', '#2663A3', '#3D8A6B', '#614F8A', '#A62116', '#2E1E05', '#989789'];
    public array $hatOptions = [];
    public array $mouthColorOptions = ['#D29985', '#C98276', '#E35D6A', '#DE0F0D'];
    public array $mouthOptions = [];
    public array $skinColorOptions = ['#FFDBAC', '#F5CFA0', '#EAC393', '#E0B687', '#CB9E6E', '#B68655', '#A26D3D', '#8D5524'];

    public function mount()
    {
        $this->user = Auth::user();
        $url = explode('?', $this->user->profile_photo_url);
        foreach (explode('&', $url[1]) as $chunk) {
            [$k, $v] = explode('=', $chunk);
            $params[$k] = $v;
        }

        $this->backgroundColor = urldecode($params['b']);
        $this->skinColor = urldecode($params['skinColor[]']);

        // Eyes.
        $this->eyes = urldecode($params['eyes[]']);
        $this->eyesOptions = [
            ['label' => __('Style 1'),  'value' => 'variant01'],
            ['label' => __('Style 2'),  'value' => 'variant02'],
            ['label' => __('Style 3'),  'value' => 'variant03'],
            ['label' => __('Style 4'),  'value' => 'variant04'],
            ['label' => __('Style 5'),  'value' => 'variant05'],
            ['label' => __('Style 6'),  'value' => 'variant06'],
            ['label' => __('Style 7'),  'value' => 'variant07'],
            ['label' => __('Style 8'),  'value' => 'variant09'],
            ['label' => __('Style 9'),  'value' => 'variant10'],
            ['label' => __('Style 10'), 'value' => 'variant12'],
            ['label' => __('Style 11'), 'value' => 'variant13'],
        ];

        // Eyebrows.
        $this->eyebrows = urldecode($params['eyebrows[]']);
        $this->eyebrowsOptions = [
            ['label' => __('Style 1'),  'value' => 'variant01'],
            ['label' => __('Style 2'),  'value' => 'variant02'],
            ['label' => __('Style 3'),  'value' => 'variant03'],
            ['label' => __('Style 4'),  'value' => 'variant04'],
            ['label' => __('Style 5'),  'value' => 'variant06'],
            ['label' => __('Style 6'),  'value' => 'variant07'],
            ['label' => __('Style 7'),  'value' => 'variant08'],
            ['label' => __('Style 8'),  'value' => 'variant09'],
            ['label' => __('Style 9'),  'value' => 'variant11'],
            ['label' => __('Style 10'), 'value' => 'variant12'],
            ['label' => __('Style 11'), 'value' => 'variant13'],
        ];

        // Mouths.
        $this->mouthColor = urldecode($params['mouthColor[]']);
        $this->mouth = urldecode($params['mouth[]']);
        $this->mouthOptions = [
            // Happy.
            ['label' => __('Smile 1'),  'value' => 'happy02'],
            ['label' => __('Smile 2'),  'value' => 'happy03'],
            ['label' => __('Smile 3'),  'value' => 'happy04'],
            ['label' => __('Smile 4'),  'value' => 'happy05'],
            ['label' => __('Smile 5'),  'value' => 'happy06'],
            ['label' => __('Smile 6'),  'value' => 'happy07'],
            ['label' => __('Smile 7'),  'value' => 'happy08'],
            ['label' => __('Smile 8'),  'value' => 'happy09'],
            // Sad.
            ['label' => __('Serious 1'),  'value' => 'sad01'],
            ['label' => __('Serious 2'),  'value' => 'sad02'],
            ['label' => __('Serious 3'),  'value' => 'sad03'],
            ['label' => __('Serious 4'),  'value' => 'sad04'],
            ['label' => __('Serious 5'),  'value' => 'sad05'],
            ['label' => __('Serious 6'),  'value' => 'sad06'],
            ['label' => __('Serious 7'),  'value' => 'sad07'],
            ['label' => __('Serious 8'),  'value' => 'sad08'],
            // Surprised.
            ['label' => __('Surprised 1'), 'value' => 'surprised01'],
            ['label' => __('Surprised 2'), 'value' => 'surprised02'],
            ['label' => __('Surprised 3'), 'value' => 'surprised03'],
        ];

        // Hair (Short).
        if (array_key_exists('hair[]', $params)) {
            $this->hairColor = urldecode($params['hairColor[]']);
            $this->hair = 'hair[]=' . urldecode($params['hair[]']);
        }
        else {
            $this->hair = 'hairProbability=0';
        }
        for ($i = 1; $i < 12; $i++) {
            $shortVals[] = [
                'label' => __('Short :number', ['number' => $i]),
                'value' => 'hair[]=' . sprintf("short%'.02d", $i),
            ];
        }
        $this->hairOptions[] = ['legend' => __('Short'), 'values' => $shortVals];

        // Hair (Long).
        for ($i = 1; $i < 15; $i++) {
            $longVals[] = [
                'label' => __('Long :number', ['number' => $i]),
                'value' => 'hair[]=' . sprintf("long%'.02d", $i),
            ];
        }
        $this->hairOptions[] = ['legend' => __('Long'), 'values' => $longVals];

        // Earrings.
        if (array_key_exists('accessories[]', $params)) {
            $this->accessoriesColor = urldecode($params['accessoriesColor[]']);
            $this->accessories = 'accessoriesProbability=100&accessories[]=' . urldecode($params['accessories[]']);
        }
        else {
            $this->accessories = 'accessoriesProbability=0';
        }
        $this->accessoryOptions[] = [
            'label' => __('None'),
            'value' => 'accessoriesProbability=0',
        ];
        for ($i = 1; $i < 5; $i++) {
            $this->accessoryOptions[] = [
                'label' => __('Style :number', ['number' => $i]),
                'value' => sprintf("accessoriesProbability=100&accessories[]=variant%'.02d", $i),
            ];
        }

        // Glasses.
        if (array_key_exists('glasses[]', $params)) {
            $this->glassesColor = urldecode($params['glassesColor[]']);
            $this->glasses = 'glassesProbability=100&glasses[]=' . urldecode($params['glasses[]']);
        }
        else {
            $this->glasses = 'glassesProbability=0';
        }
        $this->glassesOptions[] = [
            'label' => __('None'),
            'value' => 'glassesProbability=0',
        ];
        for ($i = 1; $i < 8; $i++) {
            $this->glassesOptions[] = [
                'label' => __('Style :number', ['number' => $i]),
                'value' => sprintf("glassesProbability=100&glasses[]=variant%'.02d", $i),
            ];
        }

        // Clothing.
        $this->clothesColor = urldecode($params['clothesColor[]']);
        $this->clothing = urldecode($params['clothing[]']);
        $this->clothingOptions = [
            ['label' => __('Style 1'), 'value' => 'variant01'],
            ['label' => __('Style 2'), 'value' => 'variant02'],
            ['label' => __('Style 3'), 'value' => 'variant05'],
            ['label' => __('Style 4'), 'value' => 'variant10'],
            ['label' => __('Style 5'), 'value' => 'variant13'],
            ['label' => __('Style 6'), 'value' => 'variant14'],
            ['label' => __('Style 7'), 'value' => 'variant15'],
            ['label' => __('Style 8'), 'value' => 'variant19'],
            ['label' => __('Style 9'), 'value' => 'variant20'],
            ['label' => __('Style 10'), 'value' => 'variant21'],
            ['label' => __('Style 11'), 'value' => 'variant22'],
            ['label' => __('Style 12'), 'value' => 'variant24'],
            ['label' => __('Style 13'), 'value' => 'variant25'],
        ];

        // Hat.
        if (array_key_exists('hat[]', $params)) {
            $this->hatColor = urldecode($params['hatColor[]']);
            $this->hat = 'hatProbability=100&hat[]=' . urldecode($params['hat[]']);
        }
        else {
            $this->hat = 'hatProbability=0';
        }
        $this->hatOptions[] = [
            'label' => __('None'),
            'value' => 'hatProbability=0',
        ];
        for ($i = 1; $i < 13; $i++) {
            $this->hatOptions[] = [
                'label' => __('Style :number', ['number' => $i]),
                'value' => sprintf("hatProbability=100&hat[]=variant%'.02d", $i),
            ];
        }

        // Beard.
        if (array_key_exists('beard[]', $params)) {
            $this->beardColor = urldecode($params['beardColor[]']);
            $this->beard = 'beardProbability=100&beard[]=' . urldecode($params['beard[]']);
        }
        else {
            $this->beard = 'beardProbability=0';
        }
        $this->beardOptions = [
            ['label' => __('None'), 'value' => 'beardProbability=0'],
            [
                'label' => __('Full'),
                'value' => 'beardProbability=100&beard[]=variant01',
            ],
            [
                'label' => __('Trim'),
                'value' => 'beardProbability=100&beard[]=variant03',
            ],
            [
                'label' => __('Bushy'),
                'value' => 'beardProbability=100&beard[]=variant04',
            ],
        ];

        $this->setProfileAvatar();
    }

    // public function updatedHairType($value)
    // {
    //     if ($value == 'none') {
    //         $this->hair = 'hairProbability=0';
    //     }
    //     else {
    //         $this->hair = 'hair[]=' . $value;
    //     }
    //     $this->setProfileAvatar();

    //     $this->user->profile_photo_path = $this->profileAvatarUrl;
    //     $this->user->save();
    // }

    public function updated()
    {
        $this->setProfileAvatar();

        $this->user->profile_photo_path = $this->profileAvatarUrl;
        $this->user->save();
    }

    public function setProfileAvatar()
    {
        $this->profileAvatarUrl = $this->api_url . 'fuse.svg?radius=50'
        . '&b=' . urlencode($this->backgroundColor)
        . '&skinColor[]=' . urlencode($this->skinColor)
        . '&hairColor[]=' . urlencode($this->hairColor)
        . '&' . $this->hair
        . '&eyes[]=' . $this->eyes
        . '&eyebrows[]=' . $this->eyebrows
        . '&mouthColor[]=' . urlencode($this->mouthColor)
        . '&mouth[]=' . $this->mouth
        . '&clothesColor[]=' . urlencode($this->clothesColor)
        . '&clothing[]=' . $this->clothing
        . '&glassesColor[]=' . urlencode($this->glassesColor)
        . '&' . $this->glasses
        . '&hatColor[]=' . urlencode($this->hatColor)
        . '&' . $this->hat
        . '&accessoriesColor[]=' . urlencode($this->accessoriesColor)
        . '&' . $this->accessories
        . '&' . $this->beard;
    }

    public function render()
    {
        return view('livewire.avatar-editor');
    }
}
