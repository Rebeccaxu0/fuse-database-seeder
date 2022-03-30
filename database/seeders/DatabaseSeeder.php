<?php

namespace Database\Seeders;

use App\Models\Role;
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
            IdeaSeeder::class,
            StartSeeder::class,
            ArtifactSeeder::class,
            DistrictSeeder::class,
        ]);
        // Make User 1 an admin and change thier login name to `admin`
        $admin = User::find(1);
        $admin->name = 'admin';
        $admin->save();
        $admin_role = Role::find(2);
        $admin->roles()->save($admin_role);
    }
}
