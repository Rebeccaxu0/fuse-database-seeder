<?php

namespace Database\Seeders;

use App\Models\User;
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
        User::factory(100)->create();
        $this->call([
            ChallengeCategorySeeder::class,
            ChallengeAndLevelSeeder::class,
            PackageSeeder::class,
            RoleSeeder::class,
            ArtifactSeeder::class,
            DistrictSeeder::class,
            IdeaSeeder::class,
        ]);
    }
}
