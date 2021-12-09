<?php

namespace Database\Seeders;

use App\Models\Role;
use App\Models\User;
use Illuminate\Database\Seeder;

class RoleSeeder extends Seeder
{
    private $defaults = [
      1 => 'Root',
      2 => 'Administrator',
      3 => 'Report Viewer',
      4 => 'Challenge Author',
      5 => 'Super Facilitator',
      6 => 'Pre-Super Facilitator',
      7 => 'Facilitator',
      8 => 'Pre-facilitator',
      9 => 'Student',
      10 => 'Anonymous Student',
    ];

    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
      foreach ($this->defaults as $id => $name) {
        $role = Role::factory();
        $role->create([
          'id'   => $id,
          'name' => $name,
        ]);
      }
      //$student_role = Role::where('name', 'Student')->first();
      //$student_role->users()->attach(User::all());
      // $admin_role = Role::where('name', 'FUSE Administrator')->first();
      // $admin_role->users()->attach(User::all());
    }
}
