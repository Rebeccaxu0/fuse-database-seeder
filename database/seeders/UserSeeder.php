<?php

namespace Database\Seeders;

use App\Models\District;
use App\Models\Role;
use App\Models\School;
use App\Models\Studio;
use App\Models\User;
use Illuminate\Database\Seeder;

class UserSeeder extends Seeder
{

    /**
     * Run the database seeds.
     *
     * @return void
     */

    public function run()
    {
        // Make User 1 an admin and change thier login name to `admin`
        $district = District::first();
        User::factory()
            ->hasAttached(Role::find(Role::ADMIN_ID))
            ->hasAttached($district)
            ->create([
              'name' => 'admin',
              'active_studio' => $district->schools->random()->studios->random()->id,
            ]);

        // Make one Super-Facilitator per District
        foreach (District::all() as $district) {
            User::factory()
                ->hasAttached(Role::find(Role::SUPER_FACILITATOR_ID))
                ->hasAttached($district)
                ->create([
                  'active_studio' => $district->schools->random()->studios->random()->id,
                ]);
        }

        // Make one to two Facilitators per School
        foreach (School::all() as $school) {
            User::factory()->count(rand(1, 2))
                ->hasAttached(Role::find(Role::FACILITATOR_ID))
                ->hasAttached($school)
                ->create([
                  'active_studio' => $school->studios->random()->id,
                ]);
        }

        // Make five to ten Students per Studio
        foreach (Studio::all() as $studio) {
            User::factory()->count(rand(5, 10))
                ->hasAttached($studio)
                ->create(['active_studio' => $studio->id]);
        }
    }
}
