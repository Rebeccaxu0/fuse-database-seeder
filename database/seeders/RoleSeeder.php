<?php

namespace Database\Seeders;

use App\Models\Role;
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
        9 => 'Anonymous Student',
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
    }

}
