<?php

namespace Database\Seeders;

use App\Models\Artifact;
use App\Models\Level;
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
      $users = \App\Models\User::all();
      foreach ($users as $user) {
        $artifact_count = rand(1, 10);
        for ($i = 0; $i < $artifact_count; $i++) {
          $team = \App\Models\User::all()
            ->random(rand(0, 2))
            ->push($user);
          Artifact::factory()
            //->hasComments(3)
            ->hasAttached($team)
            ->for(
              Level::all()->random(), 'artifactable'
            )
            ->create();
        }
      }
    }
}
