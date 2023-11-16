<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class ScheduleSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        \App\Models\Schedule::create([
            'begin_date' => '2023-09-01',
            'end_date' => '2023-12-29',
            'course_id' => 1,
            'group_id' => 1,
        ]);
        \App\Models\Schedule::create([
            'begin_date' => '2023-09-01',
            'end_date' => '2023-12-29',
            'course_id' => 2,
            'group_id' => 1,
        ]);
    }
}
