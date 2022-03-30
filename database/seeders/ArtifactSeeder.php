<?php

namespace Database\Seeders;

use App\Models\Artifact;
use App\Models\Start;
use App\Models\Studio;
use Illuminate\Database\Seeder;

class ArtifactSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $starts = Start::all();
        foreach ($starts as $start) {
            if (rand(1, 100) < 25) {
              $team = Studio::find($start->user->active_studio)->students
                    ->random(rand(0, 2))
                    ->push($start->user);
                Artifact::factory()
                    //->hasComments(3)
                    ->hasAttached($team)
                    ->for($start->level)
                    ->create();
            }
        }
    }
}
