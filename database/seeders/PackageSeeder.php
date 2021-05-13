<?php

namespace Database\Seeders;

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
        Package::factory()
          ->create([
            'name' => $name,
          ]);
      }
    }
}
