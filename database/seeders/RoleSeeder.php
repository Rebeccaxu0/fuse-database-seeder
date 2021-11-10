<?php

namespace Database\Seeders;

use App\Models\Role;
use App\Models\User;
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
        $role->create([
          'name' => $name,
        ]);
      }
      //$student_role = Role::where('name', 'Student')->first();
      //$student_role->users()->attach(User::all());
      $admin_role = Role::where('name', 'FUSE Administrator')->first();
      $admin_role->users()->attach(User::all());
    }
}
