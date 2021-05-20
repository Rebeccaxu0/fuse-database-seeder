<?php

namespace Database\Seeders;

use App\Models\Artifact;
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
        $team = \App\Models\User::all()->random(rand(0, 2))->push($user);
        Artifact::factory()
          ->count(5)
          ->hasAttached($team)
          ->create();
      }
    }
}
