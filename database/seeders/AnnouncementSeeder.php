<?php

namespace Database\Seeders;

// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use App\Models\Announcement;
use Illuminate\Database\Seeder;

class AnnouncementSeeder extends Seeder
{
    private $default = [
        'type' => 'new',
        'body' => 'Demonstration Announcement',
        'url' => 'https://www.duckduckgo.com',
        'start_at' => '1976-06-30 00:00:00',
        'end_at' => '2038-01-01 01:01:01',
    ];

    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $role = Announcement::factory();
        $role->create($this->default);
    }
}
