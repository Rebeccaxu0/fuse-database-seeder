<?php

namespace Database\Seeders;

use App\Models\ChallengeVersion;
use App\Models\Idea;
use App\Models\Level;
use App\Models\User;
use Illuminate\Database\Seeder;

class IdeaSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $users = User::all()->random(100);
        foreach ($users as $user) {
            // Only one in a hundred students will make an Idea, if that...
            if (rand(0, 99) < 99) continue;
            $idea_count = rand(0, 2);
            for ($i = 0; $i < $idea_count; $i++) {
                $inspiration = ChallengeVersion::all()->random(rand(0, 4));
                $team = User::all()
                    ->random(rand(0, 2))
                    ->push($user);
                Idea::factory()
                    ->hasAttached($team)
                    ->hasAttached($inspiration)
                    ->has(Level::factory()->count(1))
                    ->create();
            }
        }
    }
}
