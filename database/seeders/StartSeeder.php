<?php

namespace Database\Seeders;

use App\Models\Idea;
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
            $started_challenges
                = $student->studios->first()->deFactoPackage->challenges->random(3);
            foreach ($started_challenges as $challenge) {
                $cv = $challenge->challengeVersions->random();
                $level = $cv->levels->first();
                Start::factory()
                    ->for($level)
                    ->for($student)
                    ->create();
                // Start level 2 at 33% likelihood.
                if ($level->next() && rand(1, 100) < 34) {
                    Start::factory()
                        ->for($level->next())
                        ->for($student)
                        ->create();
                    // Start level 3 at 33% likelihood.
                    if ($level->next()->next() && rand(1, 100) < 34) {
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
