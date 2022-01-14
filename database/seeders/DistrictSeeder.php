<?php

namespace Database\Seeders;

use App\Models\District;
use App\Models\School;
use App\Models\Studio;
use App\Models\User;
use Illuminate\Database\Seeder;

class DistrictSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $districts = District::factory()->count(2)
            ->has(
                School::factory()->count(3)
                    ->has(
                        Studio::factory()->count(5)
                    )
            )
            ->create();

        foreach (District::all() as $district) {
            $district->users()->attach(User::all()->random(2));
        }

        foreach (School::all() as $school) {
            $school->users()->attach(User::all()->random(5));
        }

        foreach (Studio::all() as $studio) {
            $studio->users()->attach(User::all()->random(10));
        }
    }
}
