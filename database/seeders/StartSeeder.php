<?php

namespace Database\Seeders;

use App\Models\ChallengeVersion;
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
        $users = User::all();
        foreach ($users as $user) {
            // Every Idea gets a start.
            foreach ($user->ideas as $idea) {
                Start::factory()
                    ->for($idea->level)
                    ->for($user)
                    ->create();
            }
            // A few Challenges get a start.
            $started_challenges = ChallengeVersion::all()->random(3);
            foreach ($started_challenges as $cv) {
                $level = $cv->levels->first();
                Start::factory()
                    ->for($level)
                    ->for($user)
                    ->create();
                // Start level 2 at 33% likelihood.
                if ($level->next() && rand(1, 100) < 34) {
                    Start::factory()
                        ->for($level->next())
                        ->for($user)
                        ->create();
                    // Start level 3 at 33% likelihood.
                    if ($level->next()->next() && rand(1, 100) < 34) {
                        Start::factory()
                            ->for($level->next()->next())
                            ->for($user)
                            ->create();
                    }
                }
            }
        }
    }
}
