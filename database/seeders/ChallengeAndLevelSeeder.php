<?php

namespace Database\Seeders;

use App\Models\Challenge;
use App\Models\ChallengeVersion;
use App\Models\Level;
use Illuminate\Database\Seeder;
use Illuminate\Database\Eloquent\Factories\Sequence;

class ChallengeAndLevelSeeder extends Seeder
{
    private $_defaults = [
      '3D You',
      'Beats Builder',
      'Coaster Boss',
      'Cookie Customizer',
      'Crystal Ball',
      'Design to Fly',
      'Dream Home',
      'DH2: Gut Rehab',
      'Electric Apparel',
      'Eye Candy',
      'Friend Finder',
      'Game Designer',
      'Get in the Game',
      'How to Train Your Robot',
      'Jewelry Designer',
      'Just Bead It!',
      'Keychain Customizer',
      'Laser Defender',
      'LED Color Lights',
      'Look No Hands',
      'Mini Jumbotron',
      'MiniMe Animation',
      'Mobile App Designer',
      'Music Amplifier',
      'Party Lights',
      'Print My Ride',
      'Robot Obstacle Course',
      'Sculpty Pet',
      'Selfie Sticker',
      'Slow Your Roll',
      'Smart Castle',
      'Solar Roller',
      'Spaghetti Structures',
      'Video Magic Tricks',
      'VR Escape Room',
      'Wind Commander',
    ];

    /**
     * Run the database seeds.
     *
     * @return void
     */

    public function run()
    {
        foreach ($this->_defaults as $name) {
            Challenge::factory()
                ->has(
                    ChallengeVersion::factory()
                        ->state(['name' => json_encode(["en" => "{$name} v1"])])
                        ->has(Level::factory()->count(3))
                )
                ->create(
                    ['name' => $name]
                );
        }

        $challenges = ChallengeVersion::all()->each(
            function ($item, $key) {
                $order = [];
                foreach ($item->levels()->get() as $level) {
                    $order[$level->id] = count($order) + 1;
                }
                $item->set_levels_order($order);
            }
        );
    }
}
