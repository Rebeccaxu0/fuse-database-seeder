<?php

namespace Database\Seeders;

use App\Models\Challenge;
use App\Models\ChallengeCategory;
use App\Models\ChallengeVersion;
use App\Models\Level;
use Illuminate\Database\Seeder;
use Illuminate\Support\Str;

class ChallengeAndLevelSeeder extends Seeder
{
    private $_defaults = [
      'Digital Only' => [
        'Beats Builder',
        'Dream Home',
        'Dream Home 2: Gut Rehab',
        'Game Designer',
        'MiniMe Animation',
        'Sculpty Pet',
        'VR Escape Room',
        'Video Magic Tricks',
      ],
      'DIY Kit' => [
        'Look No Hands',
        'Slow Your Roll',
      ],
      '3D Printing' => [
        'Balancing Act',
        'Cookie Customizer',
        'Eye Candy',
        'Jewelry Designer',
        'Keychain Customizer',
        'Print My Ride',
      ],
      'Kit Only' => [
        'Coaster Boss',
        'Electric Apparel',
        'Just Bead It!',
        'LED Color Lights: AAA Batteries',
        'Laser Defender',
        'Solar Roller',
        'Spaghetti Structures',
        'Wind Commander',
      ],
      'Kit + Digital' => [
        'Design to Fly',
        'Friend Finder',
        'Get in the Game',
        'How to Train Your Robot',
        'Mini Jumbotron',
        'Music Amplifier',
        'Party Lights',
        'Selfie Sticker: Cameo',
        'Smart Castle',
      ],
      'Legacy' => [
        '3D You',
        'Dream Home (Desktop)',
        'Dream Home 2: Gut Rehab (Desktop)',
        'Eye Candy: Sketchup',
        'LED Color Lights',
        'Music Amplifier v1',
        'Print My Ride: Sketchup',
        'Selfie Sticker pre 2016 cutter',
        'Wind Commander: before 2015',
      ],
      'Beta' => [
        'Beats Builder (iPad)',
        'Friend Finder (iPad)',
      ],
    ];

    /**
     * Run the database seeds.
     *
     * @return void
     */

    public function run()
    {
        foreach ($this->_defaults as $category => $defaults) {
            $category_id = ChallengeCategory::firstWhere('name', $category)->id;
            $v = $category == 'Legacy' ? ' v1' : '';
            foreach ($defaults as $name) {
                Challenge::factory()
                    ->has(
                        ChallengeVersion::factory()
                          ->state([
                              'name' => $name . $v,
                              'slug' => Str::of($name)->slug('-'),
                              'gallery_note' => 'yeehah',
                              'challenge_category_id' => $category_id,
                          ])
                          ->has(Level::factory()->count(3))
                    )
                    ->create(
                        ['name' => $name]
                    );
            }
        }

        $challenges = ChallengeVersion::all()->each(
            function ($item, $key) {
                $order = [];
                foreach ($item->levels()->get() as $level) {
                    $order[$level->id] = count($order) + 1;
                }
                $item->setLevelsOrder($order);
            }
        );
    }
}

