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
    // Each Challenge may have one or more ChallengeVersions, which may belong
    // to different ChallengeCategories.
    // A Package contains Challenges.
    private $Challenges = [
        '3D You' => [
          '3D You' => 'Legacy',
        ],
        'Balancing Act' => [
          'Balancing Act' => '3D Printing',
        ],
        'Beats Builder' => [
          'Beats Builder' => 'Digital Only',
          'Beats Builder (iPad)' => 'Beta',
        ],
        'Coaster Boss' => [
          'Coaster Boss' => 'Kit Only',
        ],
        'Cookie Customizer' => [
          'Cookie Customizer' => '3D Printing',
        ],
        'Design to Fly' => [
          'Design to Fly' => 'Kit + Digital',
        ],
        'Dream Home' => [
          'Dream Home' => 'Digital Only',
          'Dream Home (sketchup)' => 'Legacy',
        ],
        'Dream Home 2: Gut Rehab' => [
          'Dream Home 2: Gut Rehab' => 'Digital Only',
          'Dream Home 2: Gut Rehab (Sketchup)' => 'Legacy',
        ],
        'Electric Apparel' => [
          'Electric Apparel' => 'Kit Only',
        ],
        'Eye Candy' => [
          'Eye Candy' => '3D Printing',
          'Eye Candy: Sketchup' => 'Legacy',
        ],
        'Friend Finder' => [
          'Friend Finder' => 'Kit + Digital',
          'Friend Finder (iPad)' => 'Beta',
        ],
        'Game Designer' => [
          'Game Designer' => 'Digital Only',
        ],
        'Get in the Game' => [
          'Get in the Game' => 'Kit + Digital',
        ],
        'How to Train Your Robot' => [
          'How to Train Your Robot' => 'Kit + Digital',
        ],
        'Jewelry Designer' => [
          'Jewelry Designer' => '3D Printing',
        ],
        'Just Bead It!' => [
          'Just Bead It!' => 'Kit Only',
        ],
        'Keychain Customizer' => [
          'Keychain Customizer' => '3D Printing',
        ],
        'LED Color Lights' => [
          'LED Color Lights: AAA' => 'Kit Only',
          'LED Color Lights: 9v' => 'Legacy',
        ],
        'Laser Defender' => [
          'Laser Defender' => 'Kit Only',
        ],
        'Look No Hands' => [
          'Look No Hands' => 'DIY Kit',
        ],
        'Mini Jumbotron' => [
          'Mini Jumbotron' => 'Kit + Digital',
        ],
        'MiniMe Animation' => [
          'MiniMe Animation' => 'Digital Only',
        ],
        'Music Amplifier' => [
          'Music Amplifier' => 'Kit + Digital',
          'Music Amplifier V1' => 'Legacy',
        ],
        'Party Lights' => [
          'Party Lights' => 'Kit + Digital',
        ],
        'Print My Ride' => [
          'Print My Ride' => '3D Printing',
          'Print My Ride: Sketchup' => 'Legacy',
        ],
        'Sculpty Pet' => [
          'Sculpty Pet' => 'Digital Only',
        ],
        'Selfie Sticker' => [
          'Selfie Sticker: Cameo' => 'Kit + Digital',
          'Selfie Sticker: Pre 2016 Cutter' => 'Legacy',
        ],
        'Slow Your Roll' => [
          'Slow Your Roll' => 'DIY Kit',
        ],
        'Smart Castle' => [
          'Smart Castle' => 'Kit + Digital',
        ],
        'Solar Roller' => [
          'Solar Roller' => 'Kit Only',
        ],
        'Spaghetti Structures' => [
          'Spaghetti Structures' => 'Kit Only',
        ],
        'VR Escape Room' => [
          'VR Escape Room' => 'Digital Only',
        ],
        'Video Magic Tricks' => [
          'Video Magic Tricks' => 'Digital Only',
        ],
        'Wind Commander' => [
          'Wind Commander' => 'Kit Only',
          'Wind Commander: before 2015' => 'Legacy',
        ],
    ];

    /**
     * Run the database seeds.
     *
     * @return void
     */

    public function run()
    {
        $categories = [];
        foreach (ChallengeCategory::all() as $c) {
            $categories[$c->name] = $c->id;
        }
        foreach ($this->Challenges as $c => $cvs) {
            $challenge = Challenge::factory()->createOne(['name' => $c]);
            foreach ($cvs as $cv => $category) {
                ChallengeVersion::factory()
                  ->state([
                      'name' => $cv,
                      'slug' => Str::of($cv)->slug('-'),
                      'gallery_note' => 'yeehah',
                      'challenge_id' => $challenge->id,
                      'challenge_category_id' => $categories[$category],
                      'gallery_wistia_video_id' => 'm3kaafst7b',
                  ])
                  ->has(Level::factory()->count(3))
                  ->create();
            }
        }

        $challenges = ChallengeVersion::all()->each(
            function ($item, $key) {
                $order = [];
                $i = 0;
                $previous_level = null;
                foreach ($item->levels()->get() as $level) {
                    $i++;
                    $order[$level->id] = $i;
                    $previous_level = $level->id;
                }
                $item->setLevelsOrder($order);
            }
        );
    }
}

