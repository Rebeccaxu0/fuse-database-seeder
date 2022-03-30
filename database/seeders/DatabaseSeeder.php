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
        $this->call([
            ChallengeCategorySeeder::class,
            ChallengeAndLevelSeeder::class,
            PackageSeeder::class,
            DistrictSeeder::class,
            RoleSeeder::class,
            UserSeeder::class,
            IdeaSeeder::class,
            StartSeeder::class,
            ArtifactSeeder::class,
        ]);
    }
}
