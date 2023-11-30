<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class AttendanceSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        \App\Models\Attendance::create([
            'student_id' => 38546,
            'type' => 'card',
            'date' => '2023-09-04',
            'group_id' => 1,
            'course_id' => 1,
            'lesson_type' => 1,
        ]);
        \App\Models\Attendance::create([
            'student_id' => 38546,
            'type' => 'machine',
            'date' => '2023-09-05',
            'group_id' => 1,
            'course_id' => 1,
            'lesson_type' => 2,
        ]);
        \App\Models\Attendance::create([
            'student_id' => 38546,
            'type' => 'friend',
            'date' => '2023-09-06',
            'group_id' => 2,
            'course_id' => 2,
            'lesson_type' => 1,
        ]);
        \App\Models\Attendance::create([
            'student_id' => 38546,
            'type' => 'card',
            'date' => '2023-09-07',
            'group_id' => 2,
            'course_id' => 2,
            'lesson_type' => 2,
        ]);
    }
}
