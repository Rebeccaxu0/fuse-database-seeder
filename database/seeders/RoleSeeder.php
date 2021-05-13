<?php

namespace Database\Seeders;

use App\Models\Role;
use Illuminate\Database\Seeder;

class RoleSeeder extends Seeder
{
    private $defaults = [
      'Root',
      'FUSE Administrator',
      'FUSE Report Viewer',
      'FUSE Challenge Author',
      'Super Facilitator',
      'Facilitator',
      'Student',
      'Anonymous Student',
    ];

    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
      foreach ($this->defaults as $name) {
        Role::factory()
          ->create([
            'name' => $name,
          ]);
      }
    }
}
