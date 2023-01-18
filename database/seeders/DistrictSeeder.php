<?php

namespace Database\Seeders;

use App\Models\District;
use App\Models\Package;
use App\Models\School;
use App\Models\Studio;
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
        $districts = District::factory()->count(10) //should be 30
            ->has(
                School::factory()->count(2) // should be 3
                    ->has(
                        Studio::factory()->count(3) // should be 5
                    )
            )
            ->create(['package_id' => Package::all()->random()]);

        foreach (Studio::all() as $studio) {
            $studio->challengeVersions()->sync($studio->deFactoPackage->challenges->random(4));
        }
    }
}
