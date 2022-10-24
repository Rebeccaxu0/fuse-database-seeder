<?php

namespace App\Http\Livewire;

use App\Models\User;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;
use Livewire\Component;

class AvatarEditor extends Component
{
    public string $api_url = 'https://avatar-api.fusestudio.net/api/pixel-art/';
    public User $user;

    // Default Grayscale values
    public string $accessories = 'accessoriesProbability=0';
    public string $accessoriesColor = '#d3d3d3';
    public string $backgroundColor = '#adacac';
    public string $beard = 'beardProbability=0';
    public string $clothing = 'variant06';
    public string $clothesColor = '#5c5c5c';
    public string $eyes = 'variant06';
    public string $eyebrows = 'variant09';
    public string $glasses = 'glassesProbability=0';
    public string $glassesColor = '#43677d';
    public string $hair = 'hair[]=long06';
    public string $hairColor = '#707070';
    public string $hat = 'hatProbability=0';
    public string $hatColor = '#614f8a';
    public string $mouth = 'sad05';
    public string $mouthColor = '#c9c9c9';
    public string $skinColor = '#e0e0e0';
    public string $previewAvatarUrl;

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
    public array $skinColorOptions = ['#FFDBAC', '#F5CFA0', '#EAC393', '#E0B687', '#CB9E6E', '#B68655', '#A26D3D', '#8D5524', '#5D3818', '#341A04'];

    public function mount()
    {
        $this->user = Auth::user();
        $url = explode('?', $this->user->profile_photo_url);
        // Set values to non-default if URL is parseable.
        if (count($url) > 1) {
            foreach (explode('&', $url[1]) as $chunk) {
                [$k, $v] = explode('=', $chunk);
                $params[$k] = $v;
            }

            $this->backgroundColor = urldecode($params['b']);
            $requiredParamVars = ['skinColor', 'eyes', 'eyebrows', 'mouthColor', 'mouth', 'clothesColor', 'clothing'];
            foreach ($requiredParamVars as $param) {
                $this->{$param} = urldecode($params["{$param}[]"]);
            }
            $optionalColoredParamVars = ['hair', 'accessories', 'glasses', 'hat'];
            foreach ($optionalColoredParamVars as $param) {
                if (array_key_exists("{$param}[]", $params)) {
                    $this->{$param . 'Color'} = urldecode($params["{$param}Color[]"]);
                    $this->{$param} = "{$param}Probability=100&{$param}[]=" . urldecode($params["{$param}[]"]);
                } else {
                    $this->{$param} = "{$param}Probability=0";
                }
            }
            if (array_key_exists('beard[]', $params)) {
                $this->beard = 'beardProbability=100&beard[]=' . urldecode($params['beard[]']);
            } else {
                $this->beard = 'beardProbability=0';
            }
        }

        // Eyes.
        $this->eyesOptions = [
            ['label' => __('Peek'),  'value' => 'variant01'],
            ['label' => __('Wide 1'),  'value' => 'variant02'],
            ['label' => __('Anime'),  'value' => 'variant03'],
            ['label' => __('Wide 2'),  'value' => 'variant04'],
            ['label' => __('Sly'),  'value' => 'variant05'],
            ['label' => __('Sleepy'),  'value' => 'variant06'],
            ['label' => __('Dazzle'),  'value' => 'variant07'],
            ['label' => __('Sleepy Side'),  'value' => 'variant09'],
            ['label' => __('Darts'),  'value' => 'variant10'],
            ['label' => __('Wide 3'), 'value' => 'variant12'],
            ['label' => __('Wide 3 Side'), 'value' => 'variant13'],
        ];

        // Eyebrows.
        $this->eyebrowsOptions = [
            ['label' => __('Glance'),  'value' => 'variant01'],
            ['label' => __('Wide 1'),  'value' => 'variant02'],
            ['label' => __('Furrow 1'),  'value' => 'variant03'],
            ['label' => __('Wide 2'),  'value' => 'variant04'],
            ['label' => __('Arched'),  'value' => 'variant06'],
            ['label' => __('Furrow 2'),  'value' => 'variant07'],
            ['label' => __('Big'),  'value' => 'variant08'],
            ['label' => __('Thin'),  'value' => 'variant09'],
            ['label' => __('Furrow 3'),  'value' => 'variant11'],
            ['label' => __('Furrow 4'), 'value' => 'variant12'],
            ['label' => __('Concerned'), 'value' => 'variant13'],
        ];

        // Mouths.
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
        $this->accessoryOptions[] = [
            'label' => __('None'),
            'value' => 'accessoriesProbability=0',
        ];
        $accessoryLabels = [__('Big'), __('Dangle 1'), __('Dangle 2'), __('Studs')];
        for ($i = 1; $i < 5; $i++) {
            $this->accessoryOptions[] = [
                'label' => $accessoryLabels[$i - 1],
                'value' => sprintf("accessoriesProbability=100&accessories[]=variant%'.02d", $i),
            ];
        }

        // Glasses.
        $this->glassesOptions[] = [
            'label' => __('None'),
            'value' => 'glassesProbability=0',
        ];
        $glassesLabels = [__('Hearts'), __('Narrow'), __('Rectangle'), __('Oval'), __('Half-Moon'), __('Half-Circle'), __('Square')];
        for ($i = 1; $i < 8; $i++) {
            $this->glassesOptions[] = [
                'label' => $glassesLabels[$i - 1],
                'value' => sprintf("glassesProbability=100&glasses[]=variant%'.02d", $i),
            ];
        }

        // Clothing.
        $this->clothingOptions = [
            ['label' => __('Stripes'), 'value' => 'variant01'],
            ['label' => __('Vee 1'), 'value' => 'variant02'],
            ['label' => __('Vee 2'), 'value' => 'variant05'],
            ['label' => __('Sleeveless'), 'value' => 'variant10'],
            ['label' => __('Sweater'), 'value' => 'variant13'],
            ['label' => __('Turtleneck'), 'value' => 'variant14'],
            ['label' => __('Crew 1'), 'value' => 'variant15'],
            ['label' => __('Overalls'), 'value' => 'variant19'],
            ['label' => __('Cardigan'), 'value' => 'variant20'],
            ['label' => __('Crew 2'), 'value' => 'variant21'],
            ['label' => __('Scoop'), 'value' => 'variant22'],
        ];

        // Hat.
        $this->hatOptions[] = [
            'label' => __('None'),
            'value' => 'hatProbability=0',
        ];
        $hatLabels = [
            __('Boater'),
            __('Porkpie'),
            __('Beanie 1'),
            __('Cap 1'),
            __('Cloche'),
            __('Boho'),
            __('Beanie 2'),
            __('Cap 2'),
            __('Bowler'),
            __('Stovetop'),
            __('Beanie 3'),
            __('Cap 3'),
        ];
        for ($i = 1; $i < 13; $i++) {
            $this->hatOptions[] = [
                'label' => $hatLabels[$i - 1],
                'value' => sprintf("hatProbability=100&hat[]=variant%'.02d", $i),
            ];
        }

        // Beard.
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

        $this->setPreviewAvatar();
    }

    public function updated()
    {
        $this->setPreviewAvatar();
    }

    public function saveAvatar()
    {
        $options = explode('?', $this->previewAvatarUrl)[1];
        $hash = md5($options);
        Storage::disk('avatars')
            ->put("{$hash}.png", fopen($this->previewAvatarUrl, 'r'));
        $this->user->profile_photo_path = "https://avatar.fusestudio.net/{$hash}.png?{$options}";
        $this->user->save();
        $this->emit('saved');
        return redirect('/user/profile');
    }

    public function setPreviewAvatar()
    {
        $this->previewAvatarUrl = $this->api_url . 'fuse.png?radius=50'
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
