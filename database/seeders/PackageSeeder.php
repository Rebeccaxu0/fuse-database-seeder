<?php

namespace Database\Seeders;

use App\Models\Challenge;
use App\Models\Package;
use Illuminate\Database\Seeder;

class PackageSeeder extends Seeder
{
    private $defaults = [
        'Discover' => 5,
        'Create' => 10,
        'Innovate' => 20,
    ];

    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        foreach ($this->defaults as $name => $number) {
            $challenges = Challenge::all()->random($number);
            Package::factory()
                ->hasAttached($challenges)
                ->create([
                    'name' => $name,
                ]);
        }
    }
}
