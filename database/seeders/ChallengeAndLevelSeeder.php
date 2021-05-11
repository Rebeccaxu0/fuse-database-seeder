<?php

namespace Database\Seeders;

use App\Models\Challenge;
use App\Models\Level;
use Illuminate\Database\Seeder;
use Illuminate\Database\Eloquent\Factories\Sequence;

class ChallengeAndLevelSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
      Challenge::factory()
          ->count(20)
          ->has(Level::factory()
              ->count(3)
              ->state(new Sequence(
                  ['level_number' => 1],
                  ['level_number' => 2],
                  ['level_number' => 3],
              ))
          )
          ->create();
    }
}
