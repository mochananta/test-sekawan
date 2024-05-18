<?php

namespace Database\Seeders;

use App\Models\Driver;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class DriverSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run()
    {
        $drivers = [
            ['name' => 'John Doe'],
            ['name' => 'Jane Smith'],
            ['name' => 'Alice Johnson'],
            ['name' => 'Robert Brown'],
            ['name' => 'Michael Davis'],
            ['name' => 'Emily Wilson'],
            ['name' => 'David Martinez'],
            ['name' => 'Sarah Anderson'],
            ['name' => 'James Taylor'],
            ['name' => 'Maria Hernandez'],
            ['name' => 'Paul Clark'],
            ['name' => 'Laura Lewis'],
            ['name' => 'Daniel Lee'],
            ['name' => 'Emma Walker'],
            ['name' => 'Mark Hall'],
            ['name' => 'Nancy Young'],
            ['name' => 'Charles King'],
            ['name' => 'Jessica Wright'],
            ['name' => 'Thomas Scott'],
            ['name' => 'Karen Green']
        ];

        foreach ($drivers as $driver) {
            Driver::create($driver);
        }
    }
}
