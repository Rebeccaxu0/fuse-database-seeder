<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
      \App\Models\User::factory(10)->create();
      $this->call([
        ChallengeAndLevelSeeder::class,
        PackageSeeder::class,
        RoleSeeder::class,
      ]);
      $challenges = \App\Models\Challenge::all();
      $packages = \App\Models\Package::all();
      foreach ($packages as $package) {
        $package->challenges()->attach($challenges->random(5));
      }
      $users = \App\Models\User::all();
      $roles = \App\Models\Role::all();
      foreach ($roles as $role) {
        $role->users()->attach($users->random(5));
      }
    }
}
