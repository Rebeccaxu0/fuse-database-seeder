<?php

namespace Database\Seeders;

use App\Models\Challenge;
use App\Models\Package;
use Illuminate\Database\Seeder;

class PackageSeeder extends Seeder
{
    private $defaults = [
        'Discover',
        'Create',
        'Innovate',
    ];

    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        foreach ($this->defaults as $name) {
            $challenges = Challenge::all()->random(5);
            Package::factory()
                ->hasAttached($challenges)
                ->create([
                    'name' => $name,
                ]);
        }
    }
}
