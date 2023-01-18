<?php

namespace Database\Seeders;

use App\Models\Idea;
use App\Models\Level;
use App\Models\Start;
use App\Models\User;
use Illuminate\Database\Seeder;

class StartSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        // Get first level for every challenge.
        $firstLevels = Level::where('level_number', '=', 1)
            ->where('levelable_type', '=', 'App\Models\ChallengeVersion')
            ->get();
        // Every Idea gets a start.
        foreach (Idea::all() as $idea) {
            foreach ($idea->users as $user) {
                $start = Start::factory()
                    ->for($idea->levels->first())
                    ->for($user)
                    ->create();
            }
        }
        foreach (User::doesntHave('roles')->get() as $student) {
            // A few Challenges get a start.
            $startedChallengeVersions
                = $student->deFactoStudios()->first()->challengeVersions->random(3);
            $startedLevels = $firstLevels->filter(fn($value, $key) => $startedChallengeVersions->contains($value->levelable));
            foreach ($startedLevels as $level) {
                Start::factory()
                    ->for($level)
                    ->for($student)
                    ->create();
                // Start level 2 at 33% likelihood.
                if ($level->next() && rand(1, 100) < 20) {
                    Start::factory()
                        ->for($level->next())
                        ->for($student)
                        ->create();
                    // Start level 3 at 33% likelihood.
                    if ($level->next()->next() && rand(1, 100) < 20) {
                        Start::factory()
                            ->for($level->next()->next())
                            ->for($student)
                            ->create();
                    }
                }
            }
        }
    }
}
