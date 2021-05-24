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
      \App\Models\User::factory(100)->create();
      $this->call([
        ChallengeAndLevelSeeder::class,
        PackageSeeder::class,
        RoleSeeder::class,
        ArtifactSeeder::class,
        DistrictSeeder::class,
      ]);
    }
}
