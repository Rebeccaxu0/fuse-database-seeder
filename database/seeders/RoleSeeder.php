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
        $role = Role::factory();
        if ($name == 'Student') {
          $users = \App\Models\User::all();
          $role->hasAttached($users);
        }
        $role->create([
          'name' => $name,
        ]);
      }
    }
}
