<?php

namespace Database\Seeders;

use App\Models\Partner;
use Illuminate\Database\Seeder;

class PartnerSeeder extends Seeder
{
    private $defaults = [
        1 => 'Boeing',
        2 => 'CompTIA',
        3 => 'Mazda',
        4 => 'Siemens',
        5 => 'Smithfield',
    ];

    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        foreach ($this->defaults as $id => $name) {
            $role = Partner::factory();
            $role->create([
                'id'   => $id,
                'name' => $name,
                'description' => '',
            ]);
        }
    }
}
