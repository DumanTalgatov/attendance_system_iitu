<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class CourseSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        \App\Models\Course::create([
            'name' => 'Course1',
            'course_type' => 1,
            'teacher_id' => 2,
        ]);
        \App\Models\Course::create([
            'name' => 'Course1',
            'course_type' => 2,
            'teacher_id' => 2,
        ]);
        \App\Models\Course::create([
            'name' => 'Course2',
            'course_type' => 1,
            'teacher_id' => 2,
        ]);
        \App\Models\Course::create([
            'name' => 'Course2',
            'course_type' => 2,
            'teacher_id' => 2,
        ]);
    }
}
