<?php

namespace Database\Seeders;

use App\Models\GradeLevel;
use Illuminate\Database\Seeder;

class GradeLevelSeeder extends Seeder
{
    private $defaults = [
        1 => 'K-3',
        2 => '4th',
        3 => '5th',
        4 => '6th',
        5 => '7th',
        6 => '8th',
        7 => '9th',
        8 => '10th',
        8 => '11th',
        8 => '12th',
        8 => '13th+',
    ];

    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        foreach ($this->defaults as $id => $name) {
            $role = GradeLevel::factory();
            $role->create([
                'id'   => $id,
                'name' => $name,
            ]);
        }
    }
}
